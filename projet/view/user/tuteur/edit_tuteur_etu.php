<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php 
include_once("../../../model/user/responsable_model.php");
$sid = $_GET['sid'];  
$info = getinfo_etututeur($sid);
$add_new_note="non";
if(!isset($info['note'])){
	$add_new_note="oui";
}
?>
<form method="post" action="../../../controller/user/tuteur/edit_etuteur.php" role="form">
	<div class="modal-body">
		<div class="form-group">
			<label for="etu">Etudiant</label>
			<input type="text" class="form-control" id="etu" name="etu" value="<?php echo $info['nom'].' '.$info['prenom'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<label for="sid">Stage ID</label>
			<input type="text" class="form-control" id="sid" name="sid" value="<?php echo $info['sid'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<label for="stage">Stage</label>
			<input type="text" class="form-control" id="stage" name="stage" value="<?php echo $info['titre'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<label for="note">Note</label>
			<input type="text" class="form-control" id="note" name="note" value="<?php echo $info['note'];?>"/>
		</div>
		<div class="form-group">
			<label for="commentaire">Commentaire</label>
			<input type="text" class="form-control" id="commentaire" name="commentaire" value="<?php echo $info['commentaire'];?>" />
		</div> 
		<div class="form-group">
			<label for="add_new_note">Ajout note</label>
			<input type="text" class="form-control" id="add_new_note" name="add_new_note" value="<?php echo "$add_new_note";?>" readonly="true" />
		</div>     
		<div class="modal-footer">
			<input type="submit" class="btn btn-primary" name="update" value="Mettre à jour" />&nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
		</div>
	</div>
</form>


