<?php
	
	$id=$_POST['id'];
	$response["success"]=0;
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	if(isset($id)){
		$query="select a.latitude,a.longitude,a.id_aduan,a.topik,a.nama,d.nama_departemen,a.waktu,a.via_sms,s.nama_status,p.nama_prioritas 
		from aduan a LEFT JOIN departemen d ON a.departemen = d.id_departemen,prioritas p,status s
		where a.id_aduan='".$id."' and 
		a.status = s.id_status and a.prioritas = p.id_prioritas";
	
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			while($rows=mysql_fetch_array($result)){
				//masukin data
				$response['latitude']=$rows['latitude'];
				$response['longitude']=$rows['longitude'];
				$response['id_aduan']=$rows['id_aduan'];
				$response['topik']=$rows['topik'];
				$response['nama']=$rows['nama'];
				//dipotong 2digit terakhir karena ada /r/n
				$response['nama_departemen']=trim($rows['nama_departemen']);
				$response['waktu']=$rows['waktu'];
				$response['via_sms']=$rows['via_sms'];
				$response['nama_status']=$rows['nama_status'];
				$response['nama_prioritas']=$rows['nama_prioritas'];
			}
		}
		$query="select count(*)as jumlah_attachment from aduan a,detail_aduan da,upload u 
				where a.id_aduan='".$id."' and a.id_aduan=da.aduan and da.id_detail_aduan=u.detail_aduan;";
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			while($rows=mysql_fetch_array($result)){
			$response['jumlah_attachment']=$rows['jumlah_attachment'];
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