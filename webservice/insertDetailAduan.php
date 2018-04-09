<?php
	$isi_detail=$_POST['isi_detail'];
	$waktu_detail=date('Y-m-d H:i:s');
	$aduan=$_POST['id'];
	$petugas_detail=$_POST['petugas_detail'];
	$via=$_POST['via'];
	$no_hp=$_POST['no_hp'];
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	if($con){
		$query="insert into detail_aduan (isi_detail,waktu_detail,aduan,petugas_detail) values ('".$isi_detail."','".$waktu_detail."','".$aduan."','".$petugas_detail."')";
		$response['query']=$query;
		$result=mysql_query($query);
		$query="update aduan set status='4',info='1' where id_aduan='".$aduan."'";
		mysql_query($query);
		if($via==0){
			mysql_select_db("sms");
			$query ="insert into outbox(TextDecoded,DestinationNumber)values('".$isi_detail."','".$no_hp."')";
			$result=mysql_query($query);
		}
		$response['message']="Sukses Memasukkan data";
		$response['success']=1;
	}
	else{
		$response['message']="Koneksi ke database gagal";
		$response['success']=0;
	}
	echo json_encode($response);
?>