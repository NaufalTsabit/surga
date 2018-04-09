<?php
    $retval=array();
    $con = mysql_connect("localhost", "root", "P154n61j0");
    mysql_select_db("ticketing");
    $tahun=$_POST['tahun'];
    $awal = $tahun."-1-1";
    $akhir =($tahun+1)."-1-1";
    $query="select count(*) as aduan_masuk from aduan where aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'";
    $retval['stat'][]=mysql_fetch_assoc(mysql_query($query));
    $query="select count(*) as belum_ditindak_lanjut from aduan where info <> 1 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'";
    $retval['stat'][]=mysql_fetch_assoc(mysql_query($query));
    $query="select count(*) as sudah_ditindak_lanjut from aduan where info = 1 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'";
    $retval['stat'][]=mysql_fetch_assoc(mysql_query($query));
    $query="select count(*) as sudah_selesai from aduan where aduan.status = 4 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'";
    $retval['stat'][]=mysql_fetch_assoc(mysql_query($query));
    $query="select count(*) as `sampah` from aduan where spam = 1 and aduan.waktu >= '".$awal."' and aduan.waktu < '".$akhir."'";
    $retval['stat'][]=mysql_fetch_assoc(mysql_query($query));
    $query="select a.id_aduan, a.no_identitas `nik_pengadu`, a.nama `nama_pengadu`, a.waktu, 
    p.nama_petugas, d.nama_departemen, spam, a.topik `topik_aduan`, a.isi `isi_aduan` from aduan a 
    LEFT JOIN petugas p ON a.petugas=p.id_petugas LEFT JOIN departemen d ON a.departemen=d.id_departemen
    where a.waktu>='".$awal."' and a.waktu<'".$akhir."';";
    $retval['data']=array();
    $result =mysql_query($query);
    while($rows=mysql_fetch_assoc($result))
    {
        if($rows['nama_petugas']==null)
            $rows['nama_petugas']="";
        $rows['nama_departemen']=trim($rows['nama_departemen']);     
        array_push($retval['data'],$rows);
    }
    //echo json_encode($retval);
    $data['arr']=$retval;

    //print_r($data);
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="data-'.$tahun.'.csv');

    $now = date('l jS \of F Y h:i:s A');
    $f = fopen('php://output', 'w');
    $delimiter = ',';
    fputcsv($f,array("LAPORAN TAHUN",$tahun),$delimiter);
    fputcsv($f,array("DIGENERATE PADA", $now),$delimiter);
    foreach ($data['arr']['stat'] as $line) {
        $tmp = array_keys($line);
        $tmp[] = $line[$tmp[0]];
        fputcsv($f, $tmp, $delimiter);
    }

    fputcsv($f, [], $delimiter);

    fputcsv($f, array_keys($data['arr']['data'][0]), $delimiter);
    foreach ($data['arr']['data'] as $line) {
        $line['isi_aduan'] = str_replace("<p>", "", $line['isi_aduan']);
        $line['isi_aduan'] = str_replace("</p>", "", $line['isi_aduan']);
        //print_r($line);
        fputcsv($f, $line, $delimiter);
    }
?>