<?php
include_once ("../../model/etudiant/etu_model.php");
include_once ("../../model/user/responsable_model.php");
if (isset($_GET['search_button'])) {
	$reference = $_GET['reference'];
	$secret_key = 'upec';
	$secret_iv = 'etu';
	$method = 'AES-256-CBC';
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16);
	$reference_decrypt = openssl_decrypt(base64_decode($reference), $method, $key, 0, $iv);
	$info = (explode("-", $reference_decrypt));
	$eid = $info[0];
	$nom = $info[1];
	$prenom = $info[2];
	$res = info_reference_dossier($eid);
	if (isset($res['tuteur1'])) {
		$tuteur1_uid = $res['tuteur1'];
		$tuteur1 = get_tuteur($tuteur1_uid);
	} else {
		$tuteur1['nom'] = '';
		$tuteur1['prenom'] = '';
	}
	if (isset($res['tuteur2'])) {
		$tuteur2_uid = $res['tuteur2'];
		$tuteur2 = get_tuteur($tuteur2_uid);
	} else {
		$tuteur2['nom'] = '';
		$tuteur2['prenom'] = '';
	}
	if (isset($res['tuteurP'])) {
		$tuteurP_uid = $res['tuteurP'];
		$tuteurP = get_tuteur($tuteurP_uid);
	} else {
		$tuteurP['nom'] = '';
		$tuteurP['prenom'] = '';
	}
}
?>
