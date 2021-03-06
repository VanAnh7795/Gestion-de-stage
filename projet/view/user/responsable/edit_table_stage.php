<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php 
include_once ("../../../model/user/responsable_model.php");
$sid = $_GET['sid'];
$stage = get_stage($sid);
$uid_tuteurP = $stage['tuteurP'];
if(isset($stage['tuteurP'])){
$tuteurP = get_tuteur($uid_tuteurP);
}else{
	$tuteurP['nom']="";
	$tuteurP['prenom']="";
}
?>

<form method="post" action="../../../controller/user/responsable/edit_stage.php" role="form">
	<div class="modal-body">
		<div class="form-group">
			<label for="sid">ID Stage</label>
			<input type="text" class="form-control" id="sid" name="sid" value="<?php echo $stage['sid'];?>" readonly="true"/>
		</div>
		<div class="form-group">
			<label for="titre">Titre</label>
			<input type="text" class="form-control" id="titre" name="titre" value="<?php echo $stage['titre'];?>"/>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input type="text" class="form-control" id="description" name="description" value="<?php echo $stage['description'];?>"/>
		</div>
		<div class="form-group">
			<label for="entreprise">Entreprise</label>
			<input type="text" class="form-control" id="entreprise" name="entreprise" value="<?php echo $stage['entreprise'];?>" />
		</div>
		<div class="form-group">
			<label for="tuteurE">Tuteur Entreprise</label>
			<input type="text" class="form-control" id="tuteurE" name="tuteurE" value="<?php echo $stage['tuteurE'];?>"/>
		</div>
		<div class="form-group">
			<label for="emailTE">Email Tuteur Entreprise</label>
			<input type="text" class="form-control" id="emailTE" name="emailTE" value="<?php echo $stage['emailTE'];?>"/>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="tuteurP">Tuteur Pédagogique</label>
			</div>
			<select class="custom-select" id="tuteurP" name="tuteurP" >
				<option selected value="<?php echo $uid_tuteurP;?>"><?php echo $tuteurP['nom'].' '.$tuteurP['prenom'] ?></option>
				<?php
				$tuteur = select_tuteur();
				foreach ($tuteur as $row2){
					echo '<option value="'.$row2['uid'].'">'.$row2['nom'].' '.$row2['prenom'].'</option>';
				}
				?>                                 
			</select>
		</div>
	</div>
	<div class="modal-footer">
		<input type="submit" class="btn btn-primary" name="update" value="Mettre à jour" />&nbsp;
		<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
	</div>
</form>

