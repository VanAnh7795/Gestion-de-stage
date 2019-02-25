<link rel="stylesheet" type="text/css" href="../../public/css/style_commun.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style_table.css">
<link rel="stylesheet" type="text/css" href="../../public/css/style_footer.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php 
session_start();
include ("header_GA.php"); 
?>

<section>		
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">La liste de toutes les notes </h1>
		</div>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Étudiant ID</th>
				<th scope="col">Nom</th>
				<th scope="col">Prénom</th>
				<th scope="col">Date de soutenance</th>		
				<th scope="col">Note</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$mem = list_note($_SESSION['annee']);
			foreach ($mem as $row) {
				echo '<tr>';
				echo '<th scope="row">' .$row['eid'] .'</th>';
				echo '<td>' .$row['nom']. '</td>';
				echo '<td>' .$row['prenom'].'</td>';
				echo '<td>' .$row['date'].'</td>';				
				echo '<td>' .$row['note'].'</td>';
				echo '</tr>';
			}
			$mem = null;
			?>
		</tbody>
	</table>
</section>

<?php include ("../../footer.php"); ?>

