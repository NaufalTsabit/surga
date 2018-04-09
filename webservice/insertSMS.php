<?php
	$isi_sms=$_POST['isi_sms'];
	$no_hp=$_POST['no_hp_petugas'];
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("sms"); 
	if($con){
		$query ="insert into outbox(TextDecoded,DestinationNumber)values('".$isi_sms."','".$no_hp."')";
		$result=mysql_query($query);
		$response['message']="Sukses Memasukkan data";
		$response['success']=1;
	}
	else{
		$response['message']="Koneksi ke database gagal";
		$response['success']=0;
	}
	echo json_encode($response);
?>