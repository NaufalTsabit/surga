<?php
	//$role=$_POST['role'];
	//$departemen=$_POST['departemen'];
	$role=$_POST['role'];
	$departemen=$_POST['departemen'];
	$id_petugas =$_POST['id_petugas'];
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing");
		$query="select a.id_aduan,d.nama_departemen,a.waktu,a.topik,p.nama_prioritas ,a.isi
		from prioritas p, aduan a LEFT JOIN departemen d ON a.departemen=d.id_departemen
		where a.info<>'2' and a.spam='0' and a.status='4' and a.petugas='".$id_petugas."'  and 
		a.prioritas=p.id_prioritas order by a.waktu desc;";
	$result=mysql_query($query);
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
			array_push($response["aduan"],$aduan);
		}
		$response["success"]=1;
	}
	echo json_encode($response);
?>