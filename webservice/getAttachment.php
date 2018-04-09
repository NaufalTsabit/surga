<?php
	$id=$_POST['id'];
	$con = mysql_connect("localhost", "root", "P154n61j0");
	$response['success']=0;
	mysql_select_db("ticketing");
	if($con){
		if(isset($id)){
			$query="select da.waktu_detail,u.file_type,u.orig_name as nama_file,u.path_upload from aduan a,detail_aduan da,upload u 
					where a.id_aduan='".$id."' and a.id_aduan=da.aduan and da.id_detail_aduan=u.detail_aduan;";
			$result=mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$response['attachment']=array();
			while($rows=mysql_fetch_array($result)){
					$attachment = array();
					$attachment['waktu_detail']=$rows['waktu_detail'];
					$attachment['nama_file']=$rows['nama_file'];
					$attachment['path_upload']=$rows['path_upload'];
					$attachment['file_type']=$rows['file_type'];
					array_push($response['attachment'],$attachment);
				}
			}
			$response['success']=1;
		}
	}
	echo json_encode($response);
?>