<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
include_once ("../../../model/user/responsable_model.php");
$stid = $_GET['stid'];
$sou = select_stn($stid);
$uid_1 = $sou['tuteur1'];
$uid_2 = $sou['tuteur2'];
$tuteur_1 = get_tuteur($uid_1);
$tuteur_2 = get_tuteur($uid_2);
?>

<form method="post" action="../../../controller/user/responsable/edit_stn.php" role="form">
    <div class="modal-body">
        <div class="form-group">
            <label for="stid">Soutenance ID</label>
            <input type="text" class="form-control" id="stid" name="stid" value="<?php echo $sou['stid']; ?>" readonly="true"/>
        </div>
        <div class="form-group">
            <label for="sid">Stage ID</label>
            <input type="text" class="form-control" id="sid" name="sid" value="<?php echo $sou['sid']; ?>" readonly="true"/>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="tuteur1">Tuteur 1</label>
            </div>
            <select class="custom-select" id="tuteur1" name="tuteur1" >
                <option selected value="<?php echo $uid_1; ?>"><?php echo $tuteur_1['nom'] . ' ' . $tuteur_1['prenom'] ?></option>
                <?php
                $tuteur1 = select_tuteur();
                foreach ($tuteur1 as $row2) {
                    echo '<option value="' . $row2['uid'] . '">' . $row2['nom'] . ' ' . $row2['prenom'] . '</option>';
                }
                ?>                                 
            </select>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="tuteur2">Tuteur 2</label>
            </div>
            <select class="custom-select" id="tuteur2" name="tuteur2" >
                <option selected value="<?php echo $uid_2; ?>"><?php echo $tuteur_2['nom'] . ' ' . $tuteur_2['prenom'] ?></option>
                <?php
                $tuteur2 = select_tuteur();
                foreach ($tuteur2 as $row3) {
                    echo '<option value="' . $row3['uid'] . '">' . $row3['nom'] . ' ' . $row3['prenom'] . '</option>';
                }
                ?>                                 
            </select>
        </div>                                                                                                                               
        <div class="form-group">
            <label for="date">Date</label>                  
            <input type="datetime-local" class="form-control" id="date" name="date" value="<?php echo str_replace(" ", "T", $sou['date']); ?>" />
        </div>
        <div class="form-group">
            <label for="salle">Salle</label>
            <input type="text" class="form-control" id="salle" name="salle" value="<?php echo $sou['salle']; ?>"/>
        </div>    
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" name="update" value="Mettre à jour" />&nbsp;
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
    </div>
</form>
