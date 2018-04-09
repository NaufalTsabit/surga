<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	if(isset($_POST["departemen"])) {

		$departemen = $_POST["departemen"];
		
		$select = mysql_query(
		"SELECT aduan.id_aduan AS id, aduan.topik, aduan.isi, aduan.waktu, status.nama_status AS status, prioritas.nama_prioritas AS prioritas
		FROM aduan, status, departemen, prioritas
		WHERE aduan.status = status.id_status AND aduan.departemen = departemen.id_departemen 
			AND departemen.id_departemen = '$departemen'
			AND aduan.status <> (4) AND aduan.spam = 0 AND info <> (2)
			AND aduan.prioritas = prioritas.id_prioritas
		ORDER BY aduan.id_aduan;") or die(mysql_error());
	
		if(mysql_num_rows($select) > 0) {
			$response["data"] = array();
			while ($row = mysql_fetch_array($select)) {
				$listAduan = array();
				$listAduan["id"] = $row["id"];
				$listAduan["topik"] = $row["topik"];
				$listAduan["isi"] = utf8_encode($row["isi"]);
				$listAduan["waktu"] = $row["waktu"];
				$listAduan["status"] = $row["status"];
				$listAduan["prioritas"] = $row["prioritas"];
				array_push($response["data"], $listAduan);
			}
			$response["success"] = 1;
			echo json_encode($response);
		}
		else {
			$response["success"] = 0;
			$response["message"] = "Data Tidak Ditemukan";
			echo json_encode($response);
		}
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