<?php
	$role=$_POST['role'];
	$departemen=$_POST['departemen'];
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	$query="";
	if($role=="1"){
		$query="select a.status,a.id_aduan,d.nama_departemen,a.waktu,a.topik,p.nama_prioritas,a.isi
		from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen
		where a.spam='0' and a.info='2' and 
		a.prioritas=p.id_prioritas order by a.waktu desc";
	}
	else{
		$query="select a.id_aduan,d.nama_departemen,a.waktu,a.topik,p.nama_prioritas 
		from prioritas p, aduan a,departemen d 
		where a.departemen='".$departemen."' and a.spam='0' and a.info='2' and a.departemen = d.id_departemen and 
		a.prioritas=p.id_prioritas order by a.waktu desc";
	}
	$result=mysql_query ($query);
	if (mysql_num_rows($result) > 0) {
			//ambil data
		$response["aduan"]= array();
		while($rows=mysql_fetch_array($result)){
			//masukin data
			$aduan=array();
			$aduan['id_aduan']=$rows['id_aduan'];
			$aduan['nama_departemen']=trim($rows['nama_departemen']);
			$aduan['waktu']=$rows['waktu'];
			$aduan['topik']=$rows['topik'];
			$aduan['nama_prioritas']=$rows['nama_prioritas'];
			$aduan['isi']=utf8_encode($rows['isi']);
			$aduan['status']=$rows['status'];
			array_push($response["aduan"],$aduan);
		}
		$response["success"]=1;
	}
	echo json_encode($response);
?>