<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	$select = mysql_query(
		"SELECT departemen.id_departemen, departemen.nama_departemen as departemen, round(AVG(aduan.rating), 2) as rating
		FROM aduan
		RIGHT JOIN departemen
		ON aduan.departemen = departemen.id_departemen
		GROUP BY departemen.nama_departemen
		ORDER BY departemen.id_departemen;") or die(mysql_error());
	
	if(mysql_num_rows($select) > 0) {
		$response["data"] = array();
		while ($row = mysql_fetch_array($select)) {
			$tabelRating = array();
			$tabelRating["id_dept"] = $row["id_departemen"];
			$tabelRating["departemen"] = $row["departemen"];
			$tabelRating["rating"] = $row["rating"];
			array_push($response["data"], $tabelRating);
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