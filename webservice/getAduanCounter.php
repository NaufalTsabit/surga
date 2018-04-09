<?php
	
	$role=$_POST['role'];
	$departemen=$_POST['departemen'];
	$id_petugas=$_POST['id_petugas'];
	//$role="3";
	//$departemen="4";
	//$id_petugas="4";
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing");
	if($role=="1"){
		$query1="select count(a.id_aduan) as jumlah_aduan 
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
					where a.info='0' and a.spam='0' and 
					a.prioritas=p.id_prioritas order by a.waktu desc";
		$query2="select count(a.id_aduan) as jumlah_aduan
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
					where a.info='1' and a.spam='0' and 
					a.prioritas=p.id_prioritas order by a.waktu desc";
		$query3="select count(a.id_aduan)as jumlah_aduan 
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
					where a.spam='0' and a.info='2' and 
					a.prioritas=p.id_prioritas order by a.waktu desc";
		$query4="select count(a.id_aduan) as jumlah_aduan
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen where 
					a.spam='0' and a.prioritas=p.id_prioritas order by a.waktu desc";
		$result1=mysql_query($query1);
		$result2=mysql_query($query2);
		$result3=mysql_query($query3);
		$result4=mysql_query($query4);
		if (mysql_num_rows($result1) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result1)){
				//masukin data
				$response['aduanCounterNonVer']=$rows['jumlah_aduan'];
			}
		}
		if (mysql_num_rows($result2) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result2)){
				//masukin data
				$response['aduanCounterVer']=$rows['jumlah_aduan'];
			}
		}
		if (mysql_num_rows($result3) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result3)){
				//masukin data
				$response['aduanCounterKembali']=$rows['jumlah_aduan'];
			}
		}
		if (mysql_num_rows($result4) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result4)){
				//masukin data
				$response['aduanCounterAll']=$rows['jumlah_aduan'];
			}
			$response['success']=1;
		}
	}
	else{
		if($role=="2"){
			$query1="select count(*) as jumlahBelumTerjawab
				from prioritas p, aduan a,departemen d
				where a.spam='0' and a.status<>'4' and a.departemen='".$departemen."' and a.departemen = d.id_departemen and 
				a.prioritas=p.id_prioritas order by a.waktu desc;";
			$query2="select count(*) as jumlahTerjawab
					from prioritas p, aduan a,departemen d
					where a.spam='0' and a.status='4' and a.departemen='".$departemen."' and a.departemen = d.id_departemen and 
					a.prioritas=p.id_prioritas order by a.waktu desc;";
			$query3="select count(*) as jumlahSemuaAduan
					from prioritas p, aduan a,departemen d
					where a.spam='0' and a.departemen='".$departemen."' and a.departemen = d.id_departemen and 
					a.prioritas=p.id_prioritas order by a.waktu desc;  ";
		}
		else{
			$query1="select count(*) as jumlahBelumTerjawab
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
					where a.info<>'2' and a.spam='0' and a.status<>'4' and a.petugas='".$id_petugas."' and 
					a.prioritas=p.id_prioritas order by a.waktu desc;";
			$query2="select count(*) as jumlahTerjawab
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
					where a.info<>'2' and a.spam='0' and a.status='4' and a.petugas='".$id_petugas."' and 
					a.prioritas=p.id_prioritas order by a.waktu desc;";
			$query3="select count(*) as jumlahSemuaAduan
					from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
					where a.info<>'2' and a.spam='0' and a.petugas='".$id_petugas."' and 
					a.prioritas=p.id_prioritas order by a.waktu desc;";
		}
		$result1=mysql_query($query1);
		$result2=mysql_query($query2);
		$result3=mysql_query($query3);
		if (mysql_num_rows($result1) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result1)){
				//masukin data
				$response['AduanBelumTerjawab']=$rows['jumlahBelumTerjawab'];
			}
		}
		if (mysql_num_rows($result2) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result2)){
				//masukin data
				$response['AduanTerjawab']=$rows['jumlahTerjawab'];
			}
		}
		if (mysql_num_rows($result3) > 0) {
				//ambil data
			while($rows=mysql_fetch_array($result3)){
				//masukin data
				$response['SeluruhAduan']=$rows['jumlahSemuaAduan'];
			}		
			$response['success']=1;
		}
	}
	echo json_encode($response);
?>