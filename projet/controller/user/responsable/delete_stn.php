<?php
include_once ("../../../model/user/responsable_model.php");
session_start();
if(isset($_REQUEST['delete'])){
	$stid = $_REQUEST['delete'];
	delete_stn($stid);
}
?>

