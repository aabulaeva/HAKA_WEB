<?php
include("../functions.php");
sessionRequest();
$type = "";
$user_cible = "";
$user_source = "";
$montant = 0;
$msg_expl = "";
$date_creation = "";
$date_fermeture = "";
$msg_fermeture = "";
if(isset($_POST["submit"])) {
    if (!isset($_POST["dst"])){
        header("Location:ajouter.php");
    }
    if(getIdFromMail($_POST["dst"]) == 0) {
        header("Location:ajouter.php?err=user");
        $statut = 0;
    } else {
        $statut = 1;
    }
    if(isset($_POST["slider"])) {
        $type = $_POST["slider"];
        if($type == "dette") {
            $user_source = $_SESSION["id"];
            $user_cible = getIdFromMail($_POST["dst"]);
        } else {
            $user_source = getIdFromMail($_POST["dst"]);
            $user_cible = $_SESSION["id"];
        }
    } else {
        $user_source = getIdFromMail($_POST["dst"]);
        $user_cible = $_SESSION["id"];
    }
    if (isset($_POST["montant"])){
        $montant = $_POST["montant"];
    } else {
        header("Location:ajouter.php");
    }
    if (isset($_POST["msg1"])){
        $msg_expl = $_POST["msg1"];
    } else {
        header("Location:ajouter.php");
    }
    if (isset($_POST["date1"])){
        $date_creation = $_POST["date1"];
    } else {
        header("Location:ajouter.php");
    }
    if (isset($_POST["date2"])){
        $date_fermeture = $_POST["date2"];
    }
    if (isset($_POST["msg2"])){
        $msg_fermeture = $_POST["msg2"];
    }
    if($statut) {
        header("Location:../");
        addDette($user_source, $user_cible, $montant, $msg_expl, $date_creation, $statut, $date_fermeture, $msg_fermeture);
    }
}
