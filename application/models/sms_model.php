<?php

class Sms_model extends CI_Model  {

    private $sms_conn;
	function __construct()
    {
        parent::__construct();
        $this->sms_conn = $this->load->database('sms', true);
		$this->load->library('Curl');
    }

    function get_inbox($all = false)
    {
        if (!$all) $this->sms_conn->where('Processed', 'false');
        $query = $this->sms_conn->get('inbox');
        return $query->result_array();
    }

    function send_sms($data_sms)
    {
        //$this->sms_conn->insert('outbox', $data_sms);
		$data_sms['DestinationNumber'] = str_replace('+62', '0', $data_sms['DestinationNumber']);
		$data_sms['TextDecoded'] = str_replace('+', '', $data_sms['TextDecoded']);
        $data_sms['TextDecoded'] = str_replace(' ','%20',$data_sms['TextDecoded']);
        $data_sms['TextDecoded'] = str_replace('#','%23',$data_sms['TextDecoded']);
        $data_sms['TextDecoded'] = str_replace('&','%26',$data_sms['TextDecoded']);
		//$url = 'http://surga.kedirikota.go.id/api/linkSMS/'.$data_sms['DestinationNumber'].'/'.$data_sms['TextDecoded'];
		//print_r($url); exit;
		//	$this->curl->ssl(false);
		//	echo $data = $this->curl->simple_get($url);
	$url=$this->linkSMS($data_sms['DestinationNumber'],$data_sms['TextDecoded']);
	$this->getsendsms($url);	
        return ($this->sms_conn->affected_rows() != 1) ? false : true;
    }

    function linkSMS($numb,$sms){
        $host='https://smsblast.id/api/sendsingle.json';
        $username='pemkotkdrweb';
        $pass='pemkotkdrweb123';
		/*
        foreach($this->sms_model->getHLR($numb) as $s){
            //$no = $s->nomer;
            $hlr= $s->hlr;
            switch($hlr){
                default :$username='pemkotkdrweb';
                         $pass='pemkotkdrweb123';
            }
        }
		*/
        $sms = str_replace(' ','%20',$sms);
        $sms = str_replace('#','%23',$sms);
        $sms = str_replace('&','%26',$sms);
        $url=$host."?user=".$username."&password=".$pass."&senderid=Pemkot%20Kdr&message=".$sms."&msisdn=".$numb."&noaccent=1";
		
		//print_r($url); exit;
        return $url;
    }
	function getsendsms($url) {
     // $url='http://smsblast.id/api/sendsingle.json?user=pemkotkdrweb&password=pemkotkdrweb123&senderid=Pemkot%20Kdr&message=test%20sms%20surga&msisdn=6285736321938&noa$
        //$url='https://google.com';
        //phpinfo();
        $this->curl->ssl(false);
        $data = $this->curl->simple_get($url);
        //$data = '{"code":1,"status":"SUCCESS","message":"RECIPIENT PROCESSED","msgid":"9005675868"}';
        $json = json_decode($data, true);
       /* echo $json['status'];
        echo $json['message'];
        echo $json['msgid'];*/
        return $json['msgid'].'|'.$json['status'].'|'.$json['message'];
    }
    function flag_as_processed($id)
    {
        $this->sms_conn->where('ID', $id);
        $data_update = array('Processed' => 'true');
        $this->sms_conn->update('inbox', $data_update);
        return ($this->sms_conn->affected_rows() != 1) ? false : true;
    }

    function sms_not_processed($id)
    {
        $this->sms_conn->where('ID', $id);
        $this->sms_conn->where('Processed', 'false');
        $query = $this->sms_conn->get('inbox');
        if ($query->num_rows()) return true;
        return false;
    }

    function get_full_text_sms($id, $flag_all = false)
    {
        $this->sms_conn->where('ID', $id);
        $query = $this->sms_conn->get('inbox');
        $data = $query->row_array();
        $udh = $data['UDH'];
        $sender_number = $data['SenderNumber'];

        $full_sms = '';
        $udh = explode('050003', $udh);
        $udh = str_split($udh[1], 2);
        $udh_prefix = '050003' . $udh[0] . $udh[1];
        $banyak_sms = hexdec($udh[1]);
        for ($i = 1 ; $i <= $banyak_sms ; $i++) {
            $hex = dechex($i);
            $hex = strtoupper($hex);
            if (strlen($hex) == 1) {
                $hex = '0' . $hex;
            }
            $this->sms_conn->where('UDH', $udh_prefix . $hex);
            $this->sms_conn->where('SenderNumber', $sender_number);
            $this->sms_conn->order_by('ID', 'desc');
            $this->sms_conn->limit(1);
            $query = $this->sms_conn->get('inbox');
            if ($query->num_rows()) {
                $data = $query->row_array();
                $full_sms .= $data['TextDecoded'];
                if ($flag_all) $this->flag_as_processed($data['ID']);
                else if ($i != 1) $this->flag_as_processed($data['ID']);
            }
        }
        $full_sms = explode('#', $full_sms);
        $isi_aduan = '';
        $ctr = 0;
        foreach ($full_sms as $key => &$value) {
            $value = trim($value);
            $value = $this->security->xss_clean($value);
            $ctr++;
            if ($ctr > 2) {
                $isi_aduan .= $value;
            }
        }
        return $isi_aduan;
    }

    function getHLR($param = "6281101239")
    {
        if($param[0] == "+")
            $param = substr($param, 1, 5);
        else if($param[0] == "0")
            $param = "62".substr($param, 1, 3); 
        else 
            $param = substr($param, 0,5);
        $que = $this->db->query("select * from tbl_hlr where nomer = '$param'");
        return $que->result();
    }

    function get_all_sms()
    {
        $flag = array();
        $data = $this->get_inbox(true);
        echo '<table> <tr><th>Waktu</th><th>SenderNumber</th><th>ISI</th></tr>';
        foreach ($data as $key => $value) {
            echo '<tr>';
            if ($value['UDH'] && strpos($value['UDH'], '050003') !== false) {
                $row = $this->get_full_text_sms($value['ID']);
                if (!isset($flag[$row])) {
                    $flag[$row] = true;
                    echo '<td>'.$value['ReceivingDateTime'].'</td><td>'.$value['SenderNumber'].'</td><td>'.$row.'</td>';
                    // echo $row . '<br><br><br>';
                }
            } else {
                echo '<td>'.$value['ReceivingDateTime'].'</td><td>'.$value['SenderNumber'].'</td><td>'.htmlspecialchars($value['TextDecoded']).'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

}
