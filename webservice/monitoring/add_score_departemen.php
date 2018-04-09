<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("klasifikasi"); 

	if(isset($_POST["id_dept"])) {
		$response["success"] = 1;
		
		$id_dept = $_POST["id_dept"];
		$nama_dept = $_POST["nama_dept"];
		$jml_tanggapan = $_POST["jml_tanggapan"];
		$jml_baik = $_POST["jml_baik"];
		$jml_tidak_baik = $_POST["jml_tidak_baik"];
		$jml_netral = $_POST["jml_netral"];
		$score_dept = $_POST["score_dept"];
		
		$select = mysql_query("SELECT * FROM score WHERE id_dept = '$id_dept';") or die(mysql_error());
		
		if(mysql_num_rows($select) < 1) {
			$insert = mysql_query("INSERT INTO score VALUES('$id_dept', '$nama_dept', '$jml_tanggapan', '$jml_baik', '$jml_tidak_baik', '$jml_netral', '$score_dept');") or die(mysql_error());
			$response['query'] = $insert;	
		}
		else {
			$update = mysql_query(
			"UPDATE score
			SET jml_tanggapan_baik = '$jml_baik',
				jml_tanggapan_tidak_baik = '$jml_tidak_baik',
				jml_tanggapan_netral = '$jml_netral',
				score_dept = '$score_dept'
			WHERE id_dept = '$id_dept';") or die(mysql_error());
			$response['query2'] = $update;	
		}
		
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