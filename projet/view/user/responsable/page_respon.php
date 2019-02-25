<link rel="stylesheet" type="text/css" href="../../../public/css/style_commun.css">
<link rel="stylesheet" type="text/css" href="../../../public/css/style_table.css">
<link rel="stylesheet" type="text/css" href="../../../public/css/style_footer.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php
session_start();
if($_SESSION['role'] != "admin"){
	exit();
}?>
<?php include ("header_respon.php");
$uid_user= $_SESSION['uid']; 
$login = $_SESSION['login'];
$role = $_SESSION['role'];
echo "<p class=\"annonce\" style=\"color: #3070AA\">"."Hello " . $login.". Your uid is: ". $uid_user .". Your role is: ".$role."</p>";
?>

<section>
	<a href="#pédagogique"><button type="button" class="btn btn-info" style="float: left;" >Tuteur pédagogique</button></a>
	<a href="#principal"><button type="button" class="btn btn-info" style="margin-left: 400px">Tuteur principal</button></a>	
	<a href="#secondaire"><button type="button" class="btn btn-info" style="float: right;">Tuteur secondaire</button></a>			
	<div id = "pédagogique">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Le nombre des étudiants par chaque tuteur pédagogique actif</h1>
			</div>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Tuteur ID</th>
					<th scope="col">Tuteur pédagogique</th>
					<th scope="col"> Nombres des étudiants</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$mem = tuteur_pedago($_SESSION['annee']);
				foreach ($mem as $row) {
					echo '<tr>';
					echo '<th scope="row">' .$row['uid'] .'</th>';
					echo '<td>' .$row['nom'].' '.$row['prenom'].'</td>';
					echo '<td>' .$row['nb_etu'] .'</td>';
					echo '</tr>';
				}
				$mem = null;
				?>
			</tbody>
		</table>
	</div>
	<br><br><br>
	<div id = "principal">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Le nombre d’étudiants dont il est le tuteur principal pour chaque tuteur actif</h1>
			</div>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Tuteur ID</th>
					<th scope="col">Tuteur principal</th>
					<th scope="col"> Nombres des étudiants</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$mem = tuteur_princip($_SESSION['annee']);
				foreach ($mem as $row) {
					echo '<tr>';
					echo '<th scope="row">' .$row['uid'] .'</th>';
					echo '<td>' .$row['nom'].' '.$row['prenom'].'</td>';
					echo '<td>' .$row['nb_etu'] .'</td>';
					echo '</tr>';
				}
				$mem = null;
				?>
			</tbody>
		</table>
	</div>
	<br><br><br>
	<div id = "secondaire">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Le nombre d’étudiants dont il est le tuteur secondaire pour chaque tuteur actif</h1>
			</div>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Tuteur ID</th>
					<th scope="col">Tuteur secondaire</th>
					<th scope="col"> Nombres des étudiants</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$mem = tuteur_second($_SESSION['annee']);
				foreach ($mem as $row) {
					echo '<tr>';
					echo '<th scope="row">' .$row['uid'] .'</th>';
					echo '<td>' .$row['nom'].' '.$row['prenom'].'</td>';
					echo '<td>' .$row['nb_etu'] .'</td>';
					echo '</tr>';
				}
				$mem = null;
				?>
			</tbody>
		</table>
	</div>		
</section>

<?php include ("../../../footer.php"); ?>

