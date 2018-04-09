<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("klasifikasi"); 
	
	$select = mysql_query(
		"SELECT ticketing.departemen.id_departemen, ticketing.departemen.nama_departemen, COALESCE(SUM(klasifikasi.tanggapan.poin_tanggapan), 0) as score
		FROM klasifikasi.tanggapan
		RIGHT JOIN ticketing.departemen
		ON klasifikasi.tanggapan.id_dept_petugas = ticketing.departemen.id_departemen
		GROUP BY ticketing.departemen.id_departemen
		ORDER BY score DESC;") or die(mysql_error());
	
	if(mysql_num_rows($select) > 0) {
		$response["data"] = array();
		while ($row = mysql_fetch_array($select)) {
			$tabelScore = array();
			$tabelScore["id_dept"] = $row["id_departemen"];
			$tabelScore["nama_dept"] = $row["nama_departemen"];
			$tabelScore["score_dept"] = $row["score"];
			array_push($response["data"], $tabelScore);
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