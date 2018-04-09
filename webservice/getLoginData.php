<?php

	$response = array();
	if(isset($_POST["username"])){
		$username=$_POST["username"];
		$password=$_POST["password"];
	$con = mysql_connect("localhost", "root", "P154n61j0");
		mysql_select_db("ticketing"); 
		$query = "SELECT departemen,role,id_petugas FROM petugas where username_petugas='".$username."' and password_petugas='".$password."'";
		$result = mysql_query($query);	
			if (mysql_num_rows($result) > 0) {
				$response["user"] = array();
				while($rows= mysql_fetch_array($result)) {
				$user= array();
				$user['departemen']= $rows['departemen'];
				$user['role']=$rows['role'];
				$user['id_petugas']=$rows['id_petugas'];
				array_push($response["user"],$user);
				}
				$response["success"] = 1;
			}
			else{
				$response["success"] = 0;
			}
			echo json_encode($response);
	}
?>