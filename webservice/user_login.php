<?php

$response = array();
$conn = mysql_connect("localhost", "root", "P154n61j0");

if ($conn) {
	mysql_select_db("ticketing"); 

	if(isset($_POST["username"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		/*$username = "monitor";
		$password = "monitor";*/
		$select = mysql_query("SELECT * FROM petugas WHERE username_petugas = '$username' AND password_petugas = '$password'") or die(mysql_error());
		
		if(mysql_num_rows($select) > 0) {
			$response["user"] = array();
			
			while($row = mysql_fetch_array($select)) {
				$user = array();
				$user ["id"] = $row["id_petugas"];
				$user ["username"] = $row["username_petugas"];
				$user ["nama"] = $row["nama_petugas"];
				$user ["departemen"] = $row["departemen"];
				$user ["role"] = $row["role"];
				
				array_push($response["user"], $user);
			}
			
			/*$response["success"] = 1;
			echo json_encode($response);*/
			
			if($user ["role"] == 1) {
				$response["success"] = 1;
				echo json_encode($response);
			}
			else {
				$response["success"] = 0;
				$response["message"] = "Tidak Memiliki Hak Akses";
				echo json_encode($response);
			}
			
		}
		else {
			$response["success"] = 0;
			$response["message"] = "Username Atau Password Salah";
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