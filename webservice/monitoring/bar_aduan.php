<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	$selectTotal = mysql_query("SELECT COUNT(*) AS masuk FROM aduan WHERE aduan.spam = 0") or die(mysql_error());
	$selectTerjawab = mysql_query("SELECT COUNT(*) AS terjawab FROM aduan WHERE status = 4 AND aduan.spam = 0 AND info <> (2)") or die(mysql_error());
	$selectBelumTerjawab = mysql_query("SELECT COUNT(*) AS belum_terjawab FROM aduan WHERE status <> (4) AND aduan.spam = 0 AND info <> (2)") or die(mysql_error());
	
	if(mysql_num_rows($selectTotal) > 0 && mysql_num_rows($selectTerjawab) > 0 && mysql_num_rows($selectBelumTerjawab) > 0) {
		$response["data"] = array();
		
		$rowMasuk = mysql_fetch_array($selectTotal);
		$aduanMasuk = array();
		$aduanMasuk["totalMasuk"] = $rowMasuk["masuk"];
		array_push($response["data"], $aduanMasuk);
		
		$rowTerjawab = mysql_fetch_array($selectTerjawab);
		$aduanTerjawab = array();
		$aduanTerjawab["totalTerjawab"] = $rowTerjawab["terjawab"];
		array_push($response["data"], $aduanTerjawab);
		
		$rowBelumTerjawab = mysql_fetch_array($selectBelumTerjawab);
		$aduanBelumTerjawab = array();
		$aduanBelumTerjawab["totalBelumTerjawab"] = $rowBelumTerjawab["belum_terjawab"];
		array_push($response["data"], $aduanBelumTerjawab);
		
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