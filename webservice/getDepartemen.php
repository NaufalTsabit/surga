<?php	
	$con = mysql_connect("localhost", "root", "P154n61j0");
	$response['success']=0;
	mysql_select_db("ticketing");
	if($con){
		$query="select nama_petugas,no_hp_petugas from petugas where no_hp_petugas<>'null';";
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$response['petugas']=array();
			while($rows=mysql_fetch_array($result)){
				$petugas['nama_petugas']=$rows['nama_petugas'];
				$petugas['no_hp_petugas']=$rows['no_hp_petugas'];
				array_push($response['petugas'],$petugas);
			}
			$response['success']=1;
		}
	}
	echo json_encode($response);
?>