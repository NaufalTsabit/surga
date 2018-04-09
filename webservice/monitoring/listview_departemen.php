<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	$select = mysql_query(
		"SELECT departemen.id_departemen, departemen.nama_departemen, y.jml_tanggapan
		FROM departemen
		LEFT JOIN (
			SELECT departemen.id_departemen, sum(x.jumlah) AS jml_tanggapan
			FROM petugas, departemen, (
				SELECT count(*) AS jumlah, id_detail_aduan, petugas_detail
				FROM detail_aduan
				WHERE petugas_detail is not null and year(waktu_detail) = 2015
				GROUP BY petugas_detail) x
			WHERE x.petugas_detail = petugas.id_petugas and petugas.departemen = departemen.id_departemen
			GROUP BY petugas.departemen
		) y
		ON departemen.id_departemen = y.id_departemen;") or die(mysql_error());
	
	if(mysql_num_rows($select) > 0) {
		$response["data"] = array();
		while ($row = mysql_fetch_array($select)) {
			$listDepatemen = array();
			$listDepatemen["id"] = $row["id_departemen"];
			$listDepatemen["departemen"] = $row["nama_departemen"];
			$listDepatemen["jml_tanggapan"] = $row["jml_tanggapan"];
			array_push($response["data"], $listDepatemen);
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