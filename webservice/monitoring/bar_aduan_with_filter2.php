<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	if(isset($_POST["month"])) {

		$month = $_POST["month"];
		$year = $_POST["year"];
		
		$select = mysql_query(
		"SELECT departemen.id_departemen, departemen.nama_departemen AS departemen, COUNT(aduan.departemen) AS jml_masuk, terjawab.jml_terjawab, terjawab.jml_belum_terjawab
		FROM 
		(
			(
				SELECT departemen.id_departemen AS id, COUNT(aduan.departemen) AS jml_terjawab, belum.jml_belum_terjawab AS jml_belum_terjawab
				FROM
				(
					SELECT departemen.id_departemen AS id, COUNT(aduan.departemen) AS jml_belum_terjawab
					FROM departemen
					LEFT JOIN aduan
					ON aduan.departemen = departemen.id_departemen AND aduan.status NOT IN (4) AND aduan.spam = 0 AND aduan.info <> (2) AND MONTH(aduan.waktu) = '$month' AND YEAR(aduan.waktu) = '$year'
					GROUP BY departemen.nama_departemen, MONTH(aduan.waktu)
				) belum INNER JOIN departemen ON belum.id = departemen.id_departemen
				LEFT JOIN aduan
				ON aduan.departemen = departemen.id_departemen AND aduan.status = 4 AND aduan.spam = 0 AND aduan.info <> (2) AND MONTH(aduan.waktu) = '$month' AND YEAR(aduan.waktu) = '$year'
				GROUP BY departemen.nama_departemen, MONTH(aduan.waktu)
			) terjawab INNER JOIN departemen ON terjawab.id = departemen.id_departemen
		)
		LEFT JOIN aduan
		ON aduan.departemen = departemen.id_departemen AND aduan.departemen = terjawab.id AND aduan.spam = 0 AND MONTH(aduan.waktu) = '$month' AND YEAR(aduan.waktu) = '$year'
		GROUP BY departemen.nama_departemen, MONTH(aduan.waktu)
		ORDER BY departemen.id_departemen;") or die(mysql_error());
	
		if(mysql_num_rows($select) > 0) {
			$response["data"] = array();
			while ($row = mysql_fetch_array($select)) {
				$tabelAduan = array();
				$tabelAduan["id_departemen"] = $row["id_departemen"];
				$tabelAduan["departemen"] = $row["departemen"];
				$tabelAduan["jml_masuk"] = $row["jml_masuk"];
				$tabelAduan["jml_terjawab"] = $row["jml_terjawab"];
				$tabelAduan["jml_belum_terjawab"] = $row["jml_belum_terjawab"];
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