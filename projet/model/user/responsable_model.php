<?php

include_once (__DIR__."/../../public/libraries/db_config.php");

function checkUser($login, $password) {
    $db = connect_db();
    $SQL = "SELECT * FROM users WHERE login=:login AND mdp=:mdp";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':login'=> $login, ':mdp'=>$password));
    $res = $stmt -> fetchAll();
    if(empty($res)){
        return false;
    } else {
        return $res[0];
    }
}

function checkLogin($login){
    $db = connect_db();
    $SQL = "SELECT * FROM users WHERE login=:login";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':login'=> $login));
    $res = $stmt -> fetchAll();
    if(empty($res)){
        return true;
    } else {
        return false;
    }
}

//add User
function addUser($nom,$prenom,$login,$mdp,$role){
    $db = connect_db();
    $SQL = "INSERT INTO users(nom,prenom,login,mdp,role) 
    VALUES (:nom,:prenom,:login,:mdp,:role)";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':nom'=> $nom, ':prenom'=> $prenom, ':login'=> $login,
        ':mdp'=> $mdp, ':role'=> $role));
}

//user changer mdp
function changePw($login,$mdp){
    $db= connect_db();
    $SQL="UPDATE users SET mdp= :mdp WHERE login= :login";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':mdp'=> $mdp, ':login'=> $login));
}

//Regéner token admin
function update_token($gid,$token){
    $db= connect_db();
    $SQL="UPDATE gestionnaires SET token= :token WHERE gid= :gid";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':token'=> $token, ':gid'=> $gid));
    if ($stmt) {
     echo "Regénération token complète ...";
 }
}

//liste tous users
function list_user(){
    $db= connect_db();
    $SQL="SELECT * FROM users";
    $stmt = $db-> query($SQL);
    $res = $stmt->fetchAll();
    return $res;
}

//liste tous les gestionnaires administratifs
function list_GA(){
    $db= connect_db();
    $SQL="SELECT * FROM gestionnaires";
    $stmt = $db-> query($SQL);
    $res = $stmt->fetchAll();
    return $res;
}


function select_user($login){
    $db = connect_db();
    $SQL = "SELECT * FROM users WHERE login=:login";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':login'=> $login));
    $res = $stmt -> fetchAll();
    return $res[0];
}

function get_tuteur($uid){
    $db = connect_db();
    $SQL = "SELECT * FROM users WHERE uid=:uid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':uid'=> $uid));
    $res = $stmt -> fetchAll();
    return $res[0];
}

function desactiver($login){
    $db= connect_db();
    $SQL="UPDATE users SET actif= b'0' where login= :login";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':login'=> $login));
    if ($stmt) {
     echo "User est désactivé ...";
 }
}

function activer($login){
    $db= connect_db();
    $SQL="UPDATE users SET actif= b'1' where login= :login";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':login'=> $login));
    if ($stmt) {
     echo "User est activé ...";
 }
}

// liste tous les stages 
function list_stage($year){
    $db = connect_db();
    $SQL = "SELECT sid, titre, description, entreprise, tuteurE, emailTE, dateDebut, dateFin, 
    users.nom AS nom_user, users.prenom AS prenom_user
    FROM stages 
    LEFT JOIN users ON tuteurP= users.uid 
    WHERE YEAR(dateDebut) = :year OR YEAR(dateFin) = :year";
    $stmt = $db-> prepare($SQL);
    $stmt->execute(array(':year'=> $year));
    $res = $stmt->fetchAll();
    return $res;
}

function delete_stage($sid){
    $db = connect_db();
    $SQL = "DELETE FROM stages WHERE sid =:sid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':sid'=> $sid));
    if ($stmt) {
     echo "Suppression complète ...";
 }
}

function delete_GA($gid){
    $db = connect_db();
    $SQL = "DELETE FROM gestionnaires WHERE gid =:gid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':gid'=> $gid));
    if ($stmt) {
     echo "Suppression complète ...";
 }
}

function delete_stn($stid){
    $db = connect_db();
    $SQL = "DELETE FROM soutenances WHERE stid =:stid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':stid'=> $stid));
    if ($stmt) {
     echo "Suppression complète ...";
 }
}
function list_stn($year){
    $db = connect_db();
    $SQL = "SELECT sou.stid, sou.sid, us1.nom AS nom_us1, us1.prenom AS prenom_us1, 
    us2.nom AS nom_us2, us2.prenom AS prenom_us2, date, salle
    FROM users us1 
    INNER JOIN soutenances sou ON us1.uid = sou.tuteur1
    INNER JOIN users us2 ON us2.uid = sou.tuteur2
    INNER JOIN stages ON stages.sid = sou.sid 
    WHERE YEAR(date) = :year 
    ORDER BY (date AND nom_us1 AND nom_us2)";
    $stmt = $db-> prepare($SQL);
    $stmt->execute(array(':year'=> $year));
    $res = $stmt->fetchAll();
    return $res;

}

function editStn($stid,$tuteur1,$tuteur2,$date,$salle){
    $db= connect_db();
    $SQL="UPDATE soutenances 
    SET tuteur1=:tuteur1, tuteur2=:tuteur2, date=:date, salle=:salle where stid= :stid";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':tuteur1'=> $tuteur1, ':tuteur2'=> $tuteur2,
        ':date'=> $date, ':salle'=> $salle,':stid'=> $stid));
}

function editStage($sid, $titre, $description, $entreprise, $tuteurE, $emailTE, $tuteurP){
    $db= connect_db();
    $SQL="UPDATE stages 
    SET titre=:titre, description=:description, entreprise=:entreprise, tuteurE=:tuteurE, emailTE=:emailTE, tuteurP=:tuteurP 
    WHERE sid= :sid";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':titre'=> $titre, ':description'=> $description,':entreprise'=> $entreprise, 
        ':tuteurE'=> $tuteurE,':emailTE'=> $emailTE, ':tuteurP'=> $tuteurP, ':sid'=>$sid));
}

function addStn($sid,$tuteur1,$tuteur2,$date,$salle){
    $db = connect_db();
    $SQL = "INSERT INTO soutenances(sid,tuteur1,tuteur2,date,salle) 
    VALUES (:sid,:tuteur1,:tuteur2,:date,:salle)";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':sid'=> $sid, ':tuteur1'=> $tuteur1, ':tuteur2'=> $tuteur2, ':date'=> $date, ':salle'=> $salle));
}

function addGA($nom, $prenom, $email, $token){
    $db = connect_db();
    $SQL = "INSERT INTO gestionnaires(nom,prenom,email,token) VALUES (:nom,:prenom,:email,:token)";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':nom'=> $nom, ':prenom'=> $prenom, ':email'=> $email, ':token'=> $token));
}

// Select all sid of stages not including in soutenances
function check_sid(){
    $db = connect_db();
    $SQL = "SELECT stages.sid FROM stages WHERE stages.sid NOT IN 
    (SELECT soutenances.sid FROM soutenances)";
    $stmt = $db-> query($SQL);
    $res = $stmt->fetchAll();
    return $res;
}

function select_tuteur(){
    $db= connect_db();
    $SQL="SELECT * FROM users WHERE role = 'user' AND actif ='1' ";
    $stmt = $db-> query($SQL);
    $res = $stmt->fetchAll();
    return $res;
}

function get_stage($sid){
    $db= connect_db();
    $SQL="SELECT * FROM stages WHERE sid =:sid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':sid'=> $sid));
    $res = $stmt->fetchAll();
    return $res[0];
}

function select_stn($stid){
    $db = connect_db();
    $SQL = "SELECT * FROM soutenances WHERE stid=:stid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':stid'=> $stid));
    $res = $stmt -> fetchAll();
    return $res[0];
}

function select_stn_tuteur1($tuteur1, $year){
    $db = connect_db();
    $SQL = "SELECT sou.stid, sou.sid, sou.date, sou.salle, titre, commentaire, note 
    FROM soutenances sou 
    INNER JOIN stages ON sou.sid = stages.sid 
    LEFT JOIN notes ON notes.sid = stages.sid 
    WHERE YEAR(date) = :year AND tuteur1=:tuteur1";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':tuteur1'=> $tuteur1, ':year'=> $year));
    $res = $stmt -> fetchAll();
    return $res;
}

function select_stn_tuteur2($tuteur2, $year){
    $db = connect_db();
    $SQL = "SELECT sou.stid, sou.sid, sou.date, sou.salle, titre, commentaire, note 
    FROM soutenances sou
    INNER JOIN stages ON sou.sid = stages.sid 
    LEFT JOIN notes ON notes.sid = stages.sid 
    WHERE YEAR(date) = :year AND tuteur2=:tuteur2";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':tuteur2'=> $tuteur2, ':year'=> $year));
    $res = $stmt -> fetchAll();
    return $res;
}

// Modèle de Tuteur
function etudiant_tuteurP($id_tuteurP, $year) {
    $db = connect_db();
    $SQL = "SELECT etu.eid, stages.sid, nom, prenom, titre, commentaire, note 
    FROM etudiants etu
    INNER JOIN stages ON etu.eid = stages.eid 
    LEFT JOIN notes ON stages.sid = notes.sid 
    WHERE stages.tuteurP =:tuteurP AND (YEAR(dateDebut) = :year OR YEAR(dateFin) = :year)";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':tuteurP'=> $id_tuteurP, ':year'=> $year));
    $res = $stmt -> fetchAll();
    return $res;
}

//Récupérer infos pour editer table etudiant per tuteur
function getinfo_etututeur($sid){
    $db = connect_db();
    $SQL = "SELECT sou.stid, stages.sid,nom, prenom, titre, commentaire, note 
    FROM etudiants etu 
    INNER JOIN stages ON etu.eid = stages.eid 
    LEFT JOIN notes ON stages.sid = notes.sid 
    LEFT JOIN soutenances sou ON sou.sid = stages.sid 
    WHERE stages.sid =:sid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':sid'=> $sid));
    $res = $stmt -> fetchAll();
    return $res[0];
}

function getinfo_soututeur($sid){
    $db = connect_db();
    $SQL = "SELECT sou.stid, stages.sid, titre, date, salle, commentaire, note 
    FROM stages 
    LEFT JOIN notes ON stages.sid = notes.sid 
    LEFT JOIN soutenances sou ON sou.sid = stages.sid 
    WHERE stages.sid = :sid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':sid'=> $sid));
    $res = $stmt -> fetchAll();
    return $res[0];
}

function getMDP($uid){
    $db = connect_db();
    $SQL = "SELECT mdp FROM users WHERE uid =:uid";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':uid'=> $uid));
    $res = $stmt -> fetchAll();
    return $res[0];
}

function changeMDP($uid,$mdp){
    $db= connect_db();
    $SQL="UPDATE users SET mdp= :mdp WHERE uid= :uid";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':mdp'=> $mdp, ':uid'=> $uid));
    
}

function updateNote($sid,$note,$commentaire){
    $db= connect_db();
    $SQL="UPDATE notes SET note= :note, commentaire= :commentaire WHERE sid= :sid";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':note'=> $note, ':commentaire'=> $commentaire, ':sid'=> $sid));
}

function addNote($sid,$note,$commentaire){
    $db= connect_db();
    $SQL="INSERT INTO notes(sid,note,commentaire) VALUES (:sid,:note,:commentaire)";
    $stmt= $db->prepare($SQL);
    $stmt->execute(array(':note'=> $note, ':commentaire'=> $commentaire, ':sid'=> $sid));
}

function getSID($titre){
    $db = connect_db();
    $SQL = "SELECT sid FROM stages WHERE titre =:titre";
    $stmt = $db->prepare($SQL);
    $stmt->execute(array(':titre'=> $titre));
    $res = $stmt -> fetchAll();
    return $res[0];
}

//Le nombre d’étudiants dont il est le tuteur principal
function tuteur_princip($year){
    $db = connect_db();
    $SQL = "SELECT users.uid, users.prenom, users.nom,COUNT(soutenances.sid) as nb_etu 
    FROM soutenances, users 
    WHERE users.uid = tuteur1 AND actif = b'1' AND YEAR(date) = :year 
    GROUP BY users.uid" ; 
    $stmt = $db-> prepare($SQL);
    $stmt->execute(array(':year'=> $year));
    $res = $stmt->fetchAll();
    return $res;
}

//Le nombre d’étudiants dont il est le tuteur secondaire
function tuteur_second($year){
    $db = connect_db();
    $SQL = "SELECT users.uid, users.prenom, users.nom,COUNT(soutenances.sid) as nb_etu 
    FROM soutenances, users 
    WHERE users.uid = tuteur2 AND actif = b'1' AND YEAR(date) = :year 
    GROUP BY users.uid" ; 
    $stmt = $db-> prepare($SQL);
    $stmt->execute(array(':year'=> $year));
    $res = $stmt->fetchAll();
    return $res;
}

//Le nombre des étudiants par chaque tuteur pédagogique actif
function tuteur_pedago($year){
  $db = connect_db();
  $SQL = "SELECT users.uid, users.prenom, users.nom,COUNT(stages.sid) as nb_etu 
  FROM stages 
  INNER JOIN users ON tuteurP = uid 
  WHERE actif = b'1' AND YEAR(dateDebut) = :year OR YEAR(dateFin) = :year
  GROUP BY users.uid" ; 
  $stmt = $db-> prepare($SQL);
  $stmt->execute(array(':year'=> $year));
  $res = $stmt->fetchAll();
  return $res;
}

function list_note($year){
    $db = connect_db();
    $SQL = "SELECT etu.eid, etu.nom, etu.prenom, sou.date, notes.note 
    FROM notes 
    INNER JOIN stages ON notes.sid = stages.sid 
    INNER JOIN etudiants etu ON etu.eid = stages.eid
    INNER JOIN soutenances sou ON sou.sid = stages.sid
    WHERE YEAR(date) = :year 
    ORDER BY nom OR date";
    $stmt = $db-> prepare($SQL);
    $stmt->execute(array(':year'=> $year));
    $res = $stmt->fetchAll();
    return $res;    
}

function get_token(){
    $db = connect_db();
    $SQL= "SELECT token FROM gestionnaires";
    $stmt = $db -> query($SQL);
    $res = $stmt-> fetchAll();
    return $res;
}

//select tous les annees
function select_annee(){
    $db = connect_db();
    $SQL = "SELECT DISTINCT YEAR(dateDebut) FROM stages ORDER BY YEAR(dateDebut)";
    $stmt = $db -> query($SQL);
    $res = $stmt-> fetchAll();
    return $res;
}

function echof($var) {
   echo $var;
   ob_get_level() && ob_flush();
   }

