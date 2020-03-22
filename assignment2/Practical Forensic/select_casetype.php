<?php
include("connection.php");
			
$caseid = $_POST['caseid'];
			
$sel = "select casetype from cases where caseid = ".$caseid."";	
$rel=$con->query($sel);				   
$data = mysqli_fetch_array($rel);
$output["casetype"] = $data['casetype'];			
echo json_encode($output);

?>
					

