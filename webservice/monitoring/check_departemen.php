<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("klasifikasi"); 
	
	$query = "SELECT DISTINCT id_dept_petugas FROM tanggapan ORDER BY id_dept_petugas ASC;";
	$select = mysql_query($query) or die(mysql_error());
	
	if(mysql_num_rows($select) > 0) {
		$response["data"] = array();
		while ($row = mysql_fetch_array($select)) {
			$tanggapan = array();
			$tanggapan["id_dept_petugas"] = $row["id_dept_petugas"];
			array_push($response["data"], $tanggapan);
		}
		
		$response["success"] = 1;
		echo json_encode($response);
	}
	else {
		$response["success"] = 0;
		$response["message"] = "No Data";
		echo json_encode($response);
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Failed to Connect";
	echo json_encode($response);
}

?>