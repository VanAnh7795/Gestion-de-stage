<?php
session_start();
if(isset($_REQUEST['annee'])){
	$_SESSION['annee']=$_REQUEST['annee'];
}
?>