<?php
include_once ("../../../model/user/responsable_model.php");
session_start();
if($_SESSION['role']=="admin"){
 if(isset($_REQUEST['actif'])){
   $login = $_REQUEST['actif'];
   $user = select_user($login);
   if($user['actif']==1){
    desactiver($login);
  }else{
    activer($login);
  }	
}
header("location: ../../../view/user/responsable/user_table.php");     
}