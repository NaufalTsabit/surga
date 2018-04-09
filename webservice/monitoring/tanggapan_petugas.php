<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 
	
	if(isset($_POST["id_dept"])) {

		$id_dept = $_POST["id_dept"];
		
		$select = mysql_query(
		"SELECT * FROM detail_aduan, petugas 
		WHERE YEAR(detail_aduan.waktu_detail) = 2015 AND 
		detail_aduan.petugas_detail IN (
			SELECT id_petugas
			FROM petugas
			WHERE departemen = '$id_dept'
		) AND detail_aduan.petugas_detail = petugas.id_petugas;") or die(mysql_error());
	
		if(mysql_num_rows($select) > 0) {
			$response["data"] = array();
			while ($row = mysql_fetch_array($select)) {
				$tanggapan = array();
				$tanggapan["id_tanggapan"] = $row["id_detail_aduan"];
				$x = $tanggapan["id_tanggapan"];
				$tanggapan["isi_tanggapan"] = utf8_encode($row["isi_detail"]);
				$tanggapan["waktu_tanggapan"] = $row["waktu_detail"];
				$tanggapan["id_petugas"] = $row["id_petugas"];
				$tanggapan["nama_petugas"] = $row["nama_petugas"];
				$tanggapan["departemen_petugas"] = $row["departemen"];
				
				mysql_select_db("klasifikasi");
				$select2 = mysql_query("SELECT * FROM tanggapan WHERE id_tanggapan = '$x';") or die(mysql_error());
				
				if(mysql_num_rows($select2) > 0) {
					$row2 = mysql_fetch_array($select2);
					$tanggapan["cek_tanggapan"] = 1;
					$tanggapan["kategori_tanggapan"] = $row2["kategori_tanggapan"];
				}
				else {
					$row2 = mysql_fetch_array($select2);
					$tanggapan["cek_tanggapan"] = 0;
					$tanggapan["kategori_tanggapan"] = $row2["kategori_tanggapan"];
				}
				
				array_push($response["data"], $tanggapan);
			}
			$response["success"] = 1;
		}
		else {
			$response["success"] = 0;
			$response["message"] = "Data Tidak Ditemukan";
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