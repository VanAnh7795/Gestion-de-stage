<?php
include_once ("../../../model/user/responsable_model.php");
if(isset($_POST['addSou'])){
    $res = get_stage($_POST['sid']);
    $tuteurP = $res['tuteurP'];
    if ( ($_POST['tuteur1']!= $tuteurP ) && ($_POST['tuteur2']!= $tuteurP )) {
        echo "Un deux tuteurs doit être tuteur pédagoquique du stage correspondant ! ";      
    } else {              
        $sid=$_POST['sid'];
        $tuteur1=$_POST['tuteur1'];
        $tuteur2=$_POST['tuteur2'];
        $date=$_POST['date'];
        $salle=$_POST['salle'];
        addStn($sid, $tuteur1, $tuteur2, $date, $salle);
        echo "Une soutenance a été ajouté avec succès! ";
    }
    header("location: ../../../view/user/responsable/gestion_soutenance.php");
}
?>

