<?php
	
	$id=$_POST['id'];
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	if(isset($id)){
		$query="select no_hp from aduan where id_aduan='".$id."'";
		$result=mysql_query($query);
		if(mysql_num_rows($result) >0){
			while($rows=mysql_fetch_array($result)){
				$response['no_hp']=$rows['no_hp'];	
			}
		}
		$query="select da.petugas_detail,p.nama_petugas,d.nama_departemen,a.nama,da.waktu_detail,da.isi_detail 
				from detail_aduan da LEFT JOIN petugas p ON da.petugas_detail=p.id_petugas LEFT JOIN departemen d ON p.departemen=d.id_departemen,
				aduan a
				where da.aduan='".$id."' and da.aduan = a.id_aduan";
		$result=mysql_query($query);
		if(mysql_num_rows($result) >0){
			$response['chat']=array();
			while($rows=mysql_fetch_array($result)){
				$chat=array();
				if($rows['petugas_detail']=="")
					$chat['nama']= $rows['nama'];
				else
					$chat['nama']= $rows['nama_petugas']."(".trim($rows['nama_departemen']).")";

				$chat['waktu_detail']=$rows['waktu_detail'];
				$chat['isi_detail']=utf8_encode($rows['isi_detail']);
				array_push($response['chat'],$chat);
			}
			$response['success']=1;
		}
	}
	echo json_encode($response);
?>