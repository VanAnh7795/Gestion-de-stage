<link rel="stylesheet" type="text/css" href="../../public/css/style_commun.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style_footer.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php
include_once ("header_etu.php");
include_once ("../../controller/etudiant/info_etu.php")
?>
<section>
    <div class="form-info">           
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" readonly="true"/>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom; ?>" readonly="true" />
        </div>
        <div class="form-group">
            <label for="titre">Stage</label>
            <input type="text" class="form-control" id="titre" name="titre" value="<?php echo $res['titre']; ?>" readonly="true" />
        </div>
        <div class="form-group">
            <label for="tuteurP">Tuteur Pédagogique</label>
            <input type="text" class="form-control" id="tuteurP" name="tuteurP" value="<?php echo $tuteurP['nom'] . ' ' . $tuteurP['prenom']; ?>" readonly="true" />
        </div>
        <div class="form-group">
            <label for="date">Date de soutenance</label>                  
            <input type="datetime-local" class="form-control" id="date" name="date" value="<?php echo str_replace(" ", "T", $res['date']); ?>" readonly="true"/>
        </div>
        <div class="form-group">
            <label for="salle">Salle de soutenance</label>
            <input type="text" class="form-control" id="salle" name="salle" value="<?php echo $res['salle']; ?>"readonly="true"/>
        </div> 
        <div class="form-group">
            <label for="tuteur1">Tuteur Principal</label>
            <input type="text" class="form-control" id="tuteur1" name="tuteur1" value="<?php echo $tuteur1['nom'] . ' ' . $tuteur1['prenom']; ?>"readonly="true"/>
        </div>
        <div class="form-group">
            <label for="tuteur2">Tuteur Secondaire</label>
            <input type="text" class="form-control" id="tuteur2" name="tuteur2" value="<?php echo $tuteur2['nom'] . ' ' . $tuteur2['prenom']; ?>"readonly="true"/>
        </div>
        <div class="form-group">
            <label for="note">Note</label>
            <input type="text" class="form-control" id="note" name="note" value="<?php echo $res['note']; ?>"readonly="true"/>
        </div>
        <div class="form-group">
            <label for="commentaire">Commentaire</label>
            <input type="text" class="form-control" id="commentaire" name="commentaire" value="<?php echo $res['commentaire']; ?>"readonly="true"/>
        </div>
    </div>
</section>

<?php include_once ("../../footer.php"); ?>