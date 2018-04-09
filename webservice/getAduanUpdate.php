<?php
	
	$id=$_POST['id'];
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	if(isset($id)){
		$query="select a.id_aduan,a.waktu,p.nama_petugas, d.nama_departemen, pr.nama_prioritas,s.nama_status from aduan a 
    LEFT JOIN petugas p ON a.petugas=p.id_petugas LEFT JOIN departemen d ON a.departemen=d.id_departemen 
    LEFT JOIN prioritas pr ON a.prioritas = pr.id_prioritas LEFT JOIN status s ON a.status = s.id_status where a.id_aduan='".$id."'";
	
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			while($rows=mysql_fetch_array($result)){
				//masukin data
				$response['id_aduan']=$rows['id_aduan'];
				//dipotong 2digit terakhir karena ada /r/n
				$response['nama_petugas']=trim($rows['nama_petugas']); ;
				$response['waktu']=$rows['waktu'];
				$response['nama_status']=$rows['nama_status'];
				$response['nama_prioritas']=$rows['nama_prioritas'];
			}
		}
		$query="select id_prioritas,nama_prioritas from prioritas";
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$response['prioritas']=array();
			while($rows=mysql_fetch_array($result)){
				//masukin data
				$prioritas=array();
				$prioritas['id_prioritas']=$rows['id_prioritas'];
				$prioritas['nama_prioritas']=$rows['nama_prioritas'];
				array_push($response['prioritas'],$prioritas);
			}
		}
		$query="select id_petugas,nama_petugas from petugas where role='3' and nama_petugas IS NOT NULL;";
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$response['petugas']=array();
			while($rows=mysql_fetch_array($result)){
				//masukin data
				$petugas=array();
				$petugas['id_petugas']=$rows['id_petugas'];
				$petugas['nama_petugas']=$rows['nama_petugas'];
				array_push($response['petugas'],$petugas);
			}
		}
		$query="select id_status,nama_status from status";
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$response['status']=array();
			while($rows=mysql_fetch_array($result)){
				//masukin data
				$status=array();
				$status['id_status']=$rows['id_status'];
				$status['nama_status']=$rows['nama_status'];
				array_push($response['status'],$status);
			}
		}
		$response['success']=1;

	}
	echo json_encode($response);
?>