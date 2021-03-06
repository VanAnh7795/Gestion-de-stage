<link rel="stylesheet" type="text/css" href="../../public/css/style_commun.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style_table.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style_footer.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php include("header_etu.php"); ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">La liste des soutenances</h1>
			</div>
		</div>
		<div class="row">
			<div id="member" class="col-lg-12">  
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">EID</th>
							<th scope="col">Etudiant</th>
							<th scope="col">Tuteur principal</th>
							<th scope="col">Tuteur secondaire</th>
							<th scope="col"> Date et l'heure </th>
							<th scope="col"> Salle </th>
						</tr>
					</thead>
					<tbody>
						<?php
						include_once ("../../model/etudiant/etu_model.php");
						$mem = sou_liste();
						foreach ($mem as $row) {
							echo '<tr>';
							echo '<th scope="row">' .$row['eid'] .'</th>';
							echo '<td>' .$row['etu_nom'].' '.$row['etu_prenom'].'</td>';
							echo '<td>' .$row['us1_nom'].' '.$row['us1_prenom'].'</td>';
							echo '<td>' .$row['us2_nom'].' '.$row['us2_prenom'].'</td>';
							echo '<td>' .$row['date'] .'</td>';
							echo '<td>' .$row['salle'] .'</td>';
							echo '</tr>';
						}
						$mem = null;
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<?php include ("../../footer.php"); ?>