<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['uid']);
unset($_SESSION['role']);
session_destroy();
header("location: ../../index.php");
exit();
?>