<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<?php
include_once ("../../../model/user/responsable_model.php");
session_start();
if($_SESSION['role']=="admin"){
    if(isset($_POST['update'])){
        $res = get_stage($_POST['sid']);
        $tuteurP = $res['tuteurP'];
        if ( ($_POST['tuteur1']!= $tuteurP ) && ($_POST['tuteur2']!= $tuteurP )) {
            ?>
            <script>
                bootbox.alert("Un deux tuteurs doit être tuteur pédagoquique du stage correspondant !");
            </script>
            <?php
        } else {  
            $stid=$_POST['stid'];
            $tuteur1=$_POST['tuteur1'];
            $tuteur2=$_POST['tuteur2'];
            $date=$_POST['date'];
            $salle=$_POST['salle'];
            editStn($stid, $tuteur1, $tuteur2, $date, $salle);   
        }
    }
    header ("location: ../../../view/user/responsable/gestion_soutenance.php");
} 
?>

