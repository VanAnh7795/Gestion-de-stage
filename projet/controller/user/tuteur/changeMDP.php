<?php
include_once (__DIR__."/../../../model/user/responsable_model.php");
session_start();
if(isset($_SESSION['uid'])){
    if(isset($_POST['changerMDP'])){
        $error = "";
        $pw= getMDP($_SESSION['uid']);
        if(md5($_POST['mdp_actuel'])==$pw['mdp']){
            if ( empty($_POST['mdp_nouveau']) || empty ($_POST['mdp_nouveau2'])) {
                $error .= "Nouveau Mot de pass est vide ! ";
            } else {              
                $mdp = md5($_POST['mdp_nouveau']);
                $mdp2 = md5($_POST['mdp_nouveau2']);                        ;
                if ($mdp != $mdp2){
                    $error .="MDP ne correspondent pas ";
                }
                else{
                    changeMDP($_SESSION['uid'], $mdp);
                    echo "Done";
                    header("location: ../../../view/user/tuteur/page_tuteur.php");
                }
            }            
        }
        if (!empty($error)) {
            header("location: ../../../view/user/tuteur/page_tuteur.php");
            echo $error;
        }
    }
    header("location: ../../../view/user/tuteur/page_tuteur.php");     
}
?>

