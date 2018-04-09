<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("klasifikasi"); 

	if(isset($_POST["id_tanggapan"])) {
		$response["success"] = 1;
		
		$id_tanggapan = $_POST["id_tanggapan"];
		$isi_tanggapan = $_POST["isi_tanggapan"];
		$waktu_tanggapan = $_POST["waktu_tanggapan"];
		$id_petugas = $_POST["id_petugas"];
		$nama_petugas = $_POST["nama_petugas"];
		$dept_petugas = $_POST["dept_petugas"];
		$nbayes = $_POST["nbayes"];
		$poin_tanggapan = $_POST["poin_tanggapan"];

		$insert = mysql_query("INSERT INTO tanggapan VALUES('$id_tanggapan', '$isi_tanggapan', '$waktu_tanggapan', '$id_petugas', '$nama_petugas', '$dept_petugas', '$nbayes', '$poin_tanggapan');") or die(mysql_error());
		$response['query'] = $insert;
		
		echo json_encode($response);
	}
	else {
		$response["success"] = 0;
		$response["message"] = "Error Parsing Data";
		echo json_encode($response);
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Failed to Connect";
	echo json_encode($response);
}

?>