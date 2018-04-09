<?php	
	$con = mysql_connect("localhost", "root", "P154n61j0");
	$response['success']=0;
	mysql_select_db("ticketing");
	if($con){
		$query="select distinct YEAR(waktu) as tahun from aduan;";
		$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$response['tahun']=array();
			while($rows=mysql_fetch_array($result)){
				$tahun['tahunLaporan']=$rows['tahun'];
				array_push($response['tahun'],$tahun);
			}
			$response['success']=1;
		}
	}
	echo json_encode($response);
?>