<?php
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
		$query="select id,nomor_pengirim,waktu,isi from sms_tidak_valid";
	$result=mysql_query($query);
	if (mysql_num_rows($result) > 0) {
			//ambil data
		$response["sms_tidak_valid"]= array();
		while($rows=mysql_fetch_array($result)){
			//masukin data
			$sms_tidak_valid=array();
			$sms_tidak_valid['id']=$rows['id'];
			$sms_tidak_valid['nomor_pengirim']=$rows['nomor_pengirim'];
			$sms_tidak_valid['waktu']=$rows['waktu'];
			$sms_tidak_valid['isi']=utf8_encode($rows['isi']);
			array_push($response["sms_tidak_valid"],$sms_tidak_valid);
		}
		$response["success"]=1;
	}
	echo json_encode($response);
?>