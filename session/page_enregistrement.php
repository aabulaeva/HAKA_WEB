<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>Page d'enregistrement</title>
    <?php
    include('../head.php');
    include('../functions.php');
    session_start();
    ?>
    <link rel="stylesheet" type="text/css" href="../style.css">

</head>
<body>
<?php
$validName ="";
$validName1 ="";
$validAge ="";
$validPseudo ="";
$validMail = "";
$validPassword = "";
$validPassword2 = "";
$errPseudo = "";
$errMail = "";

$inputName = "";
$inputName1 = "";
$inputAge = "";
$inputPseudo = "";
$inputMail = "";
$inputPassword = "";
$inputPassword2 = "";
$correspondance_password = "d-none";
if(isset($_POST["submit"])) {
    // Test si le nom est rentré
    if ($_POST["name1"]) {
        $validName1 = "is-valid";
    }
    else{
        $validName1 = "is-invalid d-block";
    }

    if ($_POST["name"]) {
        $validName = "is-valid";
    }
    else{
        $validName = "is-invalid d-block";
    }

    // Test si l'age est rentré
    if ($_POST["age"]) {
        $validAge = "is-valid";
    }
    else{
        $validAge = "is-invalid d-block";
    }

    // Test si le Pseudo est bien rentrée
    if ($_POST["pseudo"]) {
        $validPseudo = "is-valid";
        $inputPseudo = $_POST["pseudo"];
        $link = con();
        $query = "SELECT pseudo FROM users";
        if($result = mysqli_query($link, $query)){
            while($value = mysqli_fetch_assoc($result)) {
                if($value["pseudo"] == $inputPseudo){
                    $validPseudo = "is-invalid d-block";
                    $errPseudo = "Le pseudo est déjà utilisé";
                    break;
                }

            }
        }
        mysqli_close($link);

    }
    else{
        $validPseudo = "is-invalid d-block";
        $errPseudo = "Entrez un pseudo valide !";
    }

    // Test si l'adresse mail est au bon format
    if(strpos($_POST["mail"],'@') && strpos($_POST["mail"],'.')) {
        $validMail = "is-valid";
        $inputMail = $_POST["mail"];
        $link = con();
        $query = "SELECT mail FROM users";
        if($result = mysqli_query($link, $query)){
            while($value = mysqli_fetch_assoc($result)) {
                if($value["mail"] == $inputMail){
                    $validMail = "is-invalid d-block";
                    $errMail = "L'adresse mail est déjà utilisé";
                    break;
                }

            }
        }
        mysqli_close($link);

    }
    else {
        $validMail = "is-invalid d-block";
        $errMail = "Entrez une adresse mail valide '-----@---.---'";

    }

    // Test si le mot de passe 1 est au bon format
    if($_POST["password"] && strlen($_POST["password"])>=3 && strlen($_POST["password"])<=20) {
        $validPassword = "is-valid";
    }
    else {
        $validPassword = "is-invalid d-block";
    }

    // Test si le mot de passe 2 est au bon format
    if($_POST["password2"] && strlen($_POST["password2"])>=3 && strlen($_POST["password2"])<=20) {
        // Test si les mots de passe sont identiques
        if($_POST["password"]!=$_POST["password2"]){
            $correspondance_password = "is-invalid d-block";
        }
        else{
            $validPassword2 = "is-valid";
            $correspondance_password = "is-valid";
        }
    }
    else {
        $validPassword2 = "is-invalid d-block";
    }

    $inputName = $_POST["name"];
    $inputName1 = $_POST["name1"];
    $inputAge = $_POST["age"];
    $inputPseudo = $_POST["pseudo"];
    $inputMail = $_POST["mail"];
    $inputPassword = $_POST["password"];
    $inputPassword2 = $_POST["password2"];

    if ($validName == "is-valid" && $validName1 == "is-valid" && $validAge == "is-valid" && $validMail == "is-valid" && $validPseudo == "is-valid" && $correspondance_password == "is-valid"){
        addUser($inputMail, $inputPassword, $inputName1, $inputName, $inputAge, $inputPseudo);
        $_SESSION["connecte"] = "connecte";
        $_SESSION["id"] = getIdFromMail($inputMail);
        header("Location:../");

    }
}
?>

<div class="row mw-100">
    <div class="col-sm" ></div>
    <div class="col-md-4 m-4 bg-form">
        <h3 class="text-black mb-4 text-center">Inscription</h3>
        <?php include "form_page_enregistrement.php" ?>
    </div>
    <div class="col-sm" ></div>
</div>

</body>
</html>
