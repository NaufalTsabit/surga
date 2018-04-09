<?php
	$no_hp=$_POST['no_hp'];
	$nama=$_POST['nama'];
	$isi=$_POST['isi'];
	$no_ktp=$_POST['no_ktp'];
	$id=$_POST['id'];
	$waktu=$_POST['waktu'];
	$con = mysql_connect("localhost", "root", "P154n61j0");
	mysql_select_db("ticketing"); 
	if($con){
		$query="insert into aduan (no_identitas,nama,no_hp,isi,waktu,rating,status,prioritas,via_sms,info,spam,topik) values 
		('".$no_ktp."','".$nama."','".$no_hp."','".$isi."','".$waktu."','0','1','3','1','0','0','')";
		$response['query']=$query;
		$result=mysql_query($query);
		$query="select id_aduan from aduan where no_identitas='".$no_ktp."' and nama='".$nama."' and no_hp='".$no_hp."' 
		and waktu='".$waktu."'";
		$result=mysql_query($query);
		while($rows=mysql_fetch_array($result)){
			$id_aduan = $rows['id_aduan'];
		}
		$query ="insert into detail_aduan(isi_detail,waktu_detail,aduan) values('".$isi."','".$waktu."','".$id_aduan."')";
		$delete = "delete from sms_tidak_valid where id='".$id."'";
		mysql_query($delete);
		mysql_query($query);
		$response['message']="Sukses Memasukkan data";
		$response['success']=1;
		$response['query']=$query;
	}
	else{
		$response['message']="Koneksi ke database gagal";
		$response['success']=0;
	}
	echo json_encode($response);
?>