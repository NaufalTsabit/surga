<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	$select = mysql_query(
		"SELECT departemen.id_departemen, departemen.nama_departemen AS departemen, x.waktu
		FROM 
		(
			SELECT id_departemen as id, round(avg(TIMESTAMPDIFF(HOUR, aduan.waktu, detail_aduan.waktu_detail)), 2) as waktu
			FROM aduan
			LEFT JOIN departemen ON aduan.departemen = departemen.id_departemen
			LEFT JOIN detail_aduan ON detail_aduan.aduan = aduan.id_aduan
			WHERE aduan.status = 4 AND spam = 0 AND detail_aduan.waktu_detail = 
			(
				SELECT waktu_detail 
				FROM detail_aduan 
				WHERE detail_aduan.aduan = aduan.id_aduan 
				ORDER BY waktu_detail DESC 
				LIMIT 1
			)
			GROUP BY id_departemen
		) x 
		RIGHT JOIN departemen ON x.id = departemen.id_departemen
		GROUP BY departemen.nama_departemen
		ORDER BY departemen.id_departemen;") or die(mysql_error());
	
	if(mysql_num_rows($select) > 0) {
		$response["data"] = array();
		while ($row = mysql_fetch_array($select)) {
			$tabelAduan = array();
			$tabelAduan["id_dept"] = $row["id_departemen"];
			$tabelAduan["departemen"] = $row["departemen"];
			$tabelAduan["waktu"] = $row["waktu"];
			array_push($response["data"], $tabelAduan);
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