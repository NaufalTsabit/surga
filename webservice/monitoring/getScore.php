<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("klasifikasi"); 

	$select = mysql_query(
	"SELECT id_dept_petugas id, SUM(poin_tanggapan) as score, (
		SELECT COUNT(*)
		FROM tanggapan t
		WHERE t.kategori_tanggapan = 'BAIK' AND t.id_dept_petugas = id
	) as baik, (
		SELECT COUNT(*)
		FROM tanggapan t
		WHERE t.kategori_tanggapan = 'TIDAK BAIK' AND t.id_dept_petugas = id
	) as tidak_baik, (
		SELECT COUNT(*)
		FROM tanggapan t
		WHERE t.kategori_tanggapan = 'NETRAL' AND t.id_dept_petugas = id
	) as netral
	FROM tanggapan
	GROUP BY id_dept_petugas;") or die(mysql_error());
	
	if(mysql_num_rows($select) > 0) {
		$response["data"] = array();
		while ($row = mysql_fetch_array($select)) {
			$tanggapan = array();
			$tanggapan["id_dept_petugas"] = $row["id"];
			$tanggapan["total_score"] = $row["score"];
			$tanggapan["jml_tanggapan_baik"] = $row["baik"];
			$tanggapan["jml_tanggapan_tidak_baik"] = $row["tidak_baik"];
			$tanggapan["jml_tanggapan_netral"] = $row["netral"];
			array_push($response["data"], $tanggapan);
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
	$response["message"] = "Failed to Connect";
	echo json_encode($response);
}

?>