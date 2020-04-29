<?php
include("variables.php");

//session_request
function sessionRequest() {
    session_start();
    $time = $_SERVER['REQUEST_TIME'];
    $timeout_duration = 3600; // La session dure 1 heure
    if (isset($_SESSION["connecte"]) && $_SESSION["connecte"] == "connecte" && !isset($_SESSION['LAST_ACTIVITY'])){
        $_SESSION['LAST_ACTIVITY'] = $time;
    }
    if (isset($_SESSION['LAST_ACTIVITY']) &&
        ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        session_destroy();
        if(substr_count($_SERVER['REQUEST_URI'],"/") == 2) {
            $path = "./";
        } else if(substr_count($_SERVER['REQUEST_URI'],"/") == 3) {
            $path = "../";
        } else if(substr_count($_SERVER['REQUEST_URI'],"/") == 4) {
            $path = "../../";
        }
        header("Location:".$path."session/page_accueil.php");
    }
}

// Établi une connexion à la base
function con() {
    return mysqli_connect($GLOBALS['Server'], $GLOBALS['User'], $GLOBALS['passwrd'], $GLOBALS['database']);
}

// Retourne le nom d' un utilsateur
//nom
function getName($id) {
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT `l_name` FROM users WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    mysqli_close($con);
    return $assoc["l_name"];
}

// Retourne le prenom d' un utilsateur
//prenom
function getPrenom($id) {
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT `f_name` FROM users WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    mysqli_close($con);
    return $assoc["f_name"];
}
// Retourne le mail  d' un utilsateur
//email
function getEmail($id) {
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT `mail` FROM users WHERE id = ?;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    mysqli_close($con);
    return $assoc["mail"];
}

// Retourne l age d' un utilsateur
//age
function getAge($id) {
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT `age` FROM users WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    mysqli_close($con);
    return $assoc["age"];
}

// Retourne le nom du groupe
//nomgroupe
function getGroupName($id) {
    //echo $id;
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT * FROM groups WHERE id = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $assoc = mysqli_fetch_assoc($res);
    mysqli_free_result($res);
    mysqli_close($con);
    return $assoc;
}

// Retourne les groupes d' un utilsateur
//groupe
function getGroupNb($id) {
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT `id_g` FROM user_for_group WHERE id_u = ? ;");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $int = mysqli_num_rows($res);
    mysqli_free_result($res);
    mysqli_close($con);
    return $int;

}

//amis
function getFriends($id) {
    $con = con();
    $stmt = mysqli_prepare($con, "SELECT * FROM friends WHERE id_1 = ? OR id_2 = ? ;");
    mysqli_stmt_bind_param($stmt, 'ii', $id, $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_free_result($res);
    mysqli_close($con);
    return $data;
}

//demandeajout
function getFriendRequest($id) {
    $con = con();
    if($stmt = mysqli_prepare($con, "SELECT * FROM friends WHERE etat = 1 AND id_2= ? ;")){
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
        mysqli_free_result($res);
        mysqli_close($con);
        return $data;
    }
    else{
        mysqli_close($con);
        return 0;
    }
}

//count_demande
function getFriendRequestNb($id) {
    $con = con();
    if($stmt = mysqli_prepare($con, "SELECT * FROM friends WHERE id_2 = ? AND etat = 1;")) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $int = mysqli_num_rows($res);
        mysqli_free_result($res);
        mysqli_close($con);
        return $int;
    }
    return 0;
}


//details_dette
function getDetteDetails($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT * FROM dettes WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $donnees = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    return $donnees;
}

function getSoldeDette($id) {
    $con = con();
    $res = mysqli_prepare($con, "SELECT SUM(montant) AS solde FROM dettes WHERE id_source = ? AND statut = 1;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $donnees = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    return $donnees[0]["solde"];
}

function getSoldeCreance($id) {
    $con = con();
    $res = mysqli_prepare($con, "SELECT SUM(montant) AS solde FROM dettes WHERE id_cible = ? AND statut = 1;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $donnees = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    return $donnees[0]["solde"];
}

//editeMontant
function editMontant($id, $montant){
    $con = con();
    $res = mysqli_prepare($con, "UPDATE dettes SET montant = ? WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'ii', $montant, $id);
    mysqli_stmt_execute($res);
    mysqli_close($con);
}

//fonction pour avoir le pseudo d'un utilisateur à partir de son id
//pseudo_user
function getPseudo($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT pseudo FROM users WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $name = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    if(sizeof($name) != 0) {
        return $name[0]["pseudo"];
    } else {
        return 0;
    }
}

//fonction pour avoir id d'un utilisateur ayant un pseudo donnée
//id_user
function getIdFromPseudo($pseudo){
    $con = con();
    if($res = mysqli_prepare($con, "SELECT id FROM users WHERE pseudo = ?;")){
        mysqli_stmt_bind_param($res, 's', $pseudo);
        mysqli_stmt_execute($res);
        $data = mysqli_stmt_get_result($res);
        $id = mysqli_fetch_all($data, MYSQLI_ASSOC);
        mysqli_free_result($data);
        mysqli_close($con);
        if (isset($id[0]["id"])){
            return $id[0]["id"];
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

//fonction pour avoir id d'un utilisateur ayant une @mail donnée
//users_id
function getIdFromMail($mail){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id FROM users WHERE mail = ?;");
    mysqli_stmt_bind_param($res, 's', $mail);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $id = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    if (sizeof($id) != 0){
        return $id[0]["id"];
    } else {
        return 0;
    }
}


//fonction pour avoir la listes des dettes contractées par un utilisateur donné
//dette
function getDettes($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT * FROM dettes WHERE id_source=? OR id_cible=? ORDER BY date_creation DESC;");
    mysqli_stmt_bind_param($res, 'ii', $id, $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $assoc = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    return $assoc;
}

//fonction qui détermine si une dette est ouverte ou pas
//est_ouverte
function isOpen($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT statut FROM dettes WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $statut = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    if ($statut[0]["statut"] == "ouvert" || $statut[0]["statut"] == 1){
        return 1;
    }
    else{
        return 0;
    }


}

//fonctions pour fermer une dette : modifier son statut
//fermer_dettes
function closeDette($id, $statut, $msg){
    $con = con();
    $res = mysqli_prepare($con, "UPDATE dettes SET statut = ? WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'si', $statut, $id);
    mysqli_stmt_execute($res);
    $res = mysqli_prepare($con, "UPDATE dettes SET msg_ferm = ? WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'si', $msg, $id);
    mysqli_stmt_execute($res);
    $res = mysqli_prepare($con, "UPDATE dettes SET date_ferm = ? WHERE id = ?;");
    $date = date("Y-m-d");
    mysqli_stmt_bind_param($res, 'si', $date, $id);
    mysqli_stmt_execute($res);
    mysqli_close($con);
}

//ajouter un utilisateur
function addUser($mail, $passwrd, $f_name, $l_name, $age, $pseudo){
    $con = con();
    $res = mysqli_prepare($con, "INSERT INTO users (mail, passwrd, f_name, l_name, age, pseudo) VALUES (?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($res, 'ssssds', $mail, $passwrd, $f_name, $l_name, $age, $pseudo);
    mysqli_stmt_execute($res);
    mysqli_close($con);
}

//ajouter_dette
function addDette($id_source, $id_cible, $montant, $msg_expl, $date_crea, $statut, $date_fermeture, $msg_ferm){
    $con = con();
    $res = mysqli_prepare($con, "INSERT INTO dettes (id_source, montant, id_cible, msg_expl, date_creation, statut, date_ferm, msg_ferm) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
    mysqli_stmt_bind_param($res, 'iiisssss', $id_source, $montant, $id_cible, $msg_expl, $date_crea, $statut, $date_fermeture, $msg_ferm);
    mysqli_stmt_execute($res);
    mysqli_close($con);
    return 1;
}

//supprime une amitie
function delfriends($id_1,$id_2){
    $con = con();
    $search = mysqli_query($con, "SELECT * FROM friends");
    while (($data = mysqli_fetch_assoc($search)) != NULL){
        var_dump($data);
        if ($data["id_1"] == $id_1 && $data["id_2"]==$id_2){
            $res=mysqli_prepare($con, "DELETE FROM friends  WHERE id_1 = $id_1 AND id_2 = $id_2 ;");
            mysqli_stmt_execute($res);
            break;
        }
        else if ($data["id_1"] == $id_2 && $data["id_2"]==$id_1){
            $res=mysqli_prepare($con, "DELETE FROM friends  WHERE id_1 = $id_2 AND id_2 = $id_1 ;");
            mysqli_stmt_execute($res);
            break;
        }
        else
            echo "erreur";
    }
    mysqli_close($con);
    return;
}

//amitié confirmé
function friendsconfirmed($id_2,$id_1){
    $con = con();
    $search = mysqli_query($con, "SELECT * FROM friends WHERE etat=1 ;");
    while (($data = mysqli_fetch_assoc($search)) != NULL){
        if ($data["id_1"] == $id_1 && $data["id_2"] == $id_2){
            $res = mysqli_prepare($con, "UPDATE friends SET etat=2 WHERE id_1=$id_1 AND id_2= $id_2 ;");
            mysqli_stmt_execute($res);
            mysqli_close($con);
            echo "Vous êtes désormais amis !";
            echo "<br/>";
            break;
        } else if ($data["id_1"] == $id_2 && $data["id_2"] == $id_1 && $data["etat"]== 1){
            $res = mysqli_prepare($con, "UPDATE friends SET etat=2 WHERE id_1=$id_2 AND id_2= $id_1 ;");
            //mysqli_stmt_bind_param($res, 'dd', $id_1, $id_2);
            mysqli_stmt_execute($res);
            mysqli_close($con);
            echo "Vous êtes désormais amis !";
            echo "<br/>";
            break;
        }
    }

}

//créer une amitié entre deux utilisateurs
//create_friendship
function createFriendship($id_1, $id_2){
    $con = con();
    $search = mysqli_query($con, "SELECT * FROM friends ;");
    if ($id_1 != $id_2){
        while (($data = mysqli_fetch_assoc($search)) != NULL){
            if ($data["id_1"] == $id_1 && $data["id_2"] == $id_2 && $data["etat"]== 2){
                return 1;
            }
            else if ($data["id_1"] == $id_2 && $data["id_2"] == $id_1 && $data["etat"]== 2){
                return 1;
            }
            else if ($data["id_1"] == $id_1 && $data["id_2"] == $id_2 && $data["etat"]== 1){
                return 2;
            }
            else if ($data["id_1"] == $id_2 && $data["id_2"] == $id_1 && $data["etat"]== 1){
                return 2;
            }
        }
        $etat = 1;
        $res = mysqli_prepare($con, "INSERT INTO friends (id_1, id_2,etat) VALUES (?, ?, ?);");
        mysqli_stmt_bind_param($res, 'ddd', $id_1, $id_2, $etat);
        mysqli_stmt_execute($res);
        mysqli_close($con);
        return 0;
    }
    return 3;
}

//ajouter un nouveau groupe
function addGroup($name, $descr, $id_admin){
    $con = con();
    $res = mysqli_prepare($con, "INSERT INTO groups (`name_g`, `descr`, `admin`) VALUES (?, ?, ?);");
    mysqli_stmt_bind_param($res, 'ssd', $name, $descr, $id_admin);
    mysqli_stmt_execute($res);
    $i = mysqli_insert_id($con);
    mysqli_close($con);
    return $i;
}

function findUser($pseudo){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id FROM users WHERE pseudo = ?;");
    mysqli_stmt_bind_param($res, 's', $pseudo);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $id = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $id["id"];
}

//si l'utilisateur ayant le pseudo passé en paramètre n'existe pas dans la base de données, elle ajoute une ligne dans la table users avec un pseudo et un id
function userFound($pseudo){
  $con = con();
  $res = mysqli_prepare($con, "SELECT id FROM users WHERE pseudo = ?;");
  mysqli_stmt_bind_param($res, 's', $pseudo);
  mysqli_stmt_execute($res);
  $data = mysqli_stmt_get_result($res);
  $id = mysqli_fetch_assoc($data);
  if ($id == NULL){
    $sql = mysqli_prepare($con, "INSERT INTO users (`mail`, `passwrd`, `f_name`, `l_name`, `age`, `pseudo`) VALUES ('NULL', 'NULL','NULL', 'NULL', '0', ?);");
    mysqli_stmt_bind_param($sql, 's', $pseudo);
    mysqli_stmt_execute($sql);
    mysqli_free_result($data);
    mysqli_close($con);
    return 1;
  }
  mysqli_free_result($data);
  mysqli_close($con);
  return 0;
}

//get_group_id
function getGroupId($name){
    $con = con();
    if($res = mysqli_prepare($con, "SELECT id FROM groups WHERE `name_g` = ?;")) {
        mysqli_stmt_bind_param($res, 's', $name);
        mysqli_stmt_execute($res);
        $data = mysqli_stmt_get_result($res);
        while($id_group = mysqli_fetch_assoc($data)) {
            mysqli_free_result($data);
            mysqli_close($con);
            return $id_group;
        }
    } else {
        mysqli_close($con);
        return 0;
    }
    return 0;
}

//get_groups_details
function getGroupDetails($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT * FROM groups WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'd', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $details = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    return $details;
}

//un utilisateur rejoint un groupe
//join_group
function addUserToGroup($id_user, $id_group){
  $con =con();
  $search = mysqli_prepare($con, "SELECT * FROM user_for_group WHERE id_g = ?;");
  mysqli_stmt_bind_param($search, 'i', $id_group);
  mysqli_stmt_execute($search);
  $data = mysqli_stmt_get_result($search);
  while ($row = mysqli_fetch_assoc($data)){
    if ($row["id_u"] == $id_user){
        mysqli_free_result($data);
        mysqli_close($con);
    }
  }
  $res = mysqli_prepare($con, "INSERT INTO user_for_group (id_u, id_g) VALUES (?, ?);");
  mysqli_stmt_bind_param($res, 'dd', $id_user, $id_group);
  mysqli_stmt_execute($res);
  mysqli_close($con);
}

//groups_for_user
function getIdGroupsFromUser($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id_g FROM user_for_group WHERE id_u = ?;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $assoc = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $assoc;
}

function get_group_users($id){
    $con =con();
    $res = mysqli_prepare($con, "SELECT id_u FROM user_for_group WHERE id_g = ?;");
    mysqli_stmt_bind_param($res, 'i', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $assoc = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $assoc;    
}

function addDepense($id_group, $id_creanceir, $montant, $date, $titre){
    $con = con();
    $res = mysqli_prepare($con, "INSERT INTO depenses (id_groupe, id_creancier, montant, date_creation, titre) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($res, 'iiiss', $id_group, $id_creanceir, $montant, $date, $titre);
    mysqli_stmt_execute($res);
    $i = mysqli_insert_id($con);
    mysqli_close($con);
    return $i;
  }

//fonction qui retourne l'id d'une dépense à partir de son titre : 
function getDepenseId($titre){
    $con = con();
    $res = mysqli_prepare($con, "SELECT `id` FROM `depenses` WHERE `titre` = ?;");
    mysqli_stmt_bind_param($res, 's', $titre);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $id_depense = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $id_depense;
}

function addDebiteur($id_u, $id_d, $credit){
    $con = con();
    $res = mysqli_prepare($con, "INSERT INTO user_for_depense (id_u, id_d, credit) VALUES (?, ?, ?);");
    mysqli_stmt_bind_param($res, 'ddd', $id_u, $id_d, $credit);
    mysqli_stmt_execute($res);
    mysqli_close($con);
  }

//fonction qui retourne le nombre de débiteurs pour une dépense donnée
function getNbDebiteurs($id){
    $con = con();
    //$res = mysqli_prepare($con, "SELECT COUNT(*) FROM user_for_depense WHERE id_d = ?");
    $res = mysqli_prepare($con, "SELECT id_u FROM user_for_depense WHERE id_d = ?;");
    mysqli_stmt_bind_param($res, 'd', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $d = mysqli_fetch_assoc($data);
    /* var_dump($d);
    echo "</br>"; */
    $nb = count($d);
    mysqli_close($con);
    mysqli_free_result($data);
    //var_dump($nb);
    return $nb;
}

//fonction pour modifier le montant de tous les débiteurs
function editCredit($montant, $id_d, $id_u){
    $con = con();
    $res = mysqli_prepare($con, "UPDATE user_for_depense SET credit = ? WHERE id_d = ? AND id_u = ?;");
    mysqli_stmt_bind_param($res, 'ddd', $montant, $id_d, $id_u);
    mysqli_stmt_execute($res);
    mysqli_close($con);
}

function delGroupUser($id_u,$id_g) {
    $con = con();
    $res = mysqli_prepare($con, "DELETE FROM user_for_group WHERE id_u = ? AND id_g = ?;");
    mysqli_stmt_bind_param($res, 'dd', $id_u, $id_g);
    mysqli_stmt_execute($res);
    mysqli_close($con);
}

function delGroup($id_g) {
    $con = con();
    $res = mysqli_prepare($con, "DELETE FROM user_for_group WHERE id_g = ?;");
    mysqli_stmt_bind_param($res, 'd', $id_g);
    mysqli_stmt_execute($res);
    $res1 = mysqli_prepare($con, "DELETE FROM depenses WHERE id_groupe = ?;");
    mysqli_stmt_bind_param($res1, 'd', $id_g);
    mysqli_stmt_execute($res1);
    $res2 = mysqli_prepare($con, "DELETE FROM groups WHERE id = ?;");
    mysqli_stmt_bind_param($res2, 'd', $id_g);
    mysqli_stmt_execute($res2);
    mysqli_close($con);
}

function getGroupDepenses($id_g){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id FROM depenses WHERE id_groupe = ?;");
    mysqli_stmt_bind_param($res, 'd', $id_g);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $depenses = mysqli_fetch_all($data, MYSQLI_ASSOC);
    mysqli_free_result($data);
    mysqli_close($con);
    return $depenses;
}

function getCreancierFromDepense($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id_creancier FROM depenses WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'd', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $creancier = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $creancier;
}

function getMontantFromDepense($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT montant FROM depenses WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'd', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $montant = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $montant;
}
function getDepense() {
    
}

function getDebiteursFromDepense($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id_u FROM user_for_depense WHERE id_d = ?;");
    mysqli_stmt_bind_param($res, 'd', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $debiteurs = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $debiteurs;
}

function getDebiteurCredit($id, $id_depense){
    $con = con();
    $res = mysqli_prepare($con, "SELECT credit FROM user_for_depense WHERE id_u = ? AND id_d = ?;");
    mysqli_stmt_bind_param($res, 'dd', $id, $id_depense);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $credit = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $credit;
}

function getTitleFromDepense($id){
    $con = con();
    $res = mysqli_prepare($con, "SELECT titre FROM depenses WHERE id = ?;");
    mysqli_stmt_bind_param($res, 'd', $id);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $titre = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $titre;
}

function getMemberCredit($id, $id_dep){
    $con = con();
    $res = mysqli_prepare($con, "SELECT credit FROM user_for_depense WHERE id_u = ? AND id_d = ?;");
    mysqli_stmt_bind_param($res, 'dd', $id, $id_dep);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $credit = mysqli_fetch_assoc($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $credit;
}

function getMemberCreance($id_user, $id_groupe){
    $con = con();
    $res = mysqli_prepare($con, "SELECT sum(montant) FROM depenses WHERE id_creancier = ? AND id_groupe = ?;");
    mysqli_stmt_bind_param($res, 'dd', $id_user, $id_groupe);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $creance = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $creance;
}

//fonction qui retourne la liste des dépenses où un utilisateur donné est créancier
function getUserDepenses_creances($id_user, $id_group){
    $con  = con();
    $res = mysqli_prepare($con, "SELECT id FROM depenses WHERE id_creancier = ? AND id_groupe = ?;");
    mysqli_stmt_bind_param($res, 'dd', $id_user, $id_group);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $depenses = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $depenses;
}

function getMenberDepenses($id_user, $id_group){
    $con = con();
    $res = mysqli_prepare($con, "SELECT * FROM user_for_depense WHERE id_u = ?;");
    mysqli_stmt_bind_param($res, 'dd', $id_user, $id_groupe);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $creance = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $creance;
}

//fonction qui retourne la liste des dépenses où un user1 est créancier et un user2 est débiteur
function getSpecifiedDepense($id1, $id2, $grp){
    $con = con();
    $res = mysqli_prepare($con, "SELECT id FROM depenses JOIN user_for_depense ON id = id_d WHERE id_creancier = ? AND id_u = ? AND id_groupe = ?;");
    mysqli_stmt_bind_param($res, 'ddd', $id1, $id2, $grp);
    mysqli_stmt_execute($res);
    $data = mysqli_stmt_get_result($res);
    $depenses = mysqli_fetch_all($data);
    mysqli_free_result($data);
    mysqli_close($con);
    return $depenses;
}
?>
