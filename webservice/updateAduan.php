<?php
	$petugas=$_POST['petugas'];
	$prioritas=$_POST['prioritas'];
	$status=$_POST['status'];
	$id=$_POST['id']; 
	$spam=$_POST['spam'];
	$status_berubah=$_POST['status_berubah'];
	$sms_dinas=$_POST['sms_dinas'];
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	if($status !="" or $spam=="1" or $spam=="2"){
		if($spam=="1"){
			$query="update aduan set spam='1' where id_aduan='".$id."'";
			$response['message']="sukses tandai sebagai spam";
		}
		else if($spam=="2"){
			$query="update aduan set info='2' where id_aduan='".$id."'";
			$response['message']="sukses dikembalikan";
		}
		else{
			if($sms_dinas==1){
				$queryNoHP="select no_hp_petugas from petugas where id_petugas='".$petugas."';";
				$result1=mysql_query($queryNoHP);
				$no_hp="";
				mysql_select_db("gammu");
				while($rows = mysql_fetch_array($result1)){
					$no_hp=$rows['no_hp_petugas'];
					if($no_hp!=""){
					$queryInsertSMS ="insert into outbox(TextDecoded,DestinationNumber)values('Departemen anda mendapat aduan dengan nomor aduan : ".$id."','".$no_hp."')";
					mysql_query($queryInsertSMS);
					$response['query']=$queryInsertSMS;
					}
				}
			}
			mysql_select_db("ticketing"); 
			if($petugas=="null")
				$query="update aduan set info='1', prioritas='".$prioritas."', 
			status='".$status."' where id_aduan='".$id."'";
			else
				$query="update aduan set info='1', prioritas='".$prioritas."', petugas='".$petugas."', 
			status='".$status."' where id_aduan='".$id."'";
			if($status_berubah==1){
				$date_insert=date('Y-m-d H:i:s');
				$query1="insert into status_aduan (waktu_status_aduan,status_id_status,aduan_id_aduan) 
				values ('".$date_insert."','".$status."','".$id."')";
			$result=mysql_query($query1);
			}
			$response['message']="sukses mengupdate data";
		}
		$result=mysql_query($query);
		$response['success']="1";
	}
	else{
		$response['success']=2;
		$response['message']="Gagal mengupdate data";
	}
	echo json_encode($response);
?> 