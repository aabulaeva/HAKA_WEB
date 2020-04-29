<!doctype html>
<html lang="fr">
<head>
    <?php 
    include('../head.php'); 
    include('../functions.php');
    session_start();
    ?>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<?php
	$validMail = "";
	$validPassword = "";
	$inputMail = "";
	$inputPassword = "";
	$corres = "d-none";
	if(isset($_POST["submit"])) {
		if(!strpos($_POST["mail"],'@') || !strpos($_POST["mail"],'.')) {
			$validMail = "is-invalid d-block";
			$errMail = "Entrez une adresse mail valide";
		} else {
			$validMail = "is-valid";
		}
		if(!$_POST["password"] || strlen($_POST["password"])<3 || strlen($_POST["password"])>20) {
			$validPassword = "is-invalid d-block";
			$errPassword = "Le mot de passe n'est pas valide (3-20 caractères)";
		} else {
			$validPassword = "is-valid";
		}
		$inputMail = $_POST["mail"];
		$inputPassword = $_POST["password"];
		if($validMail == "is-valid" && $validPassword == "is-valid") {
			// Tester les correspondances en BDD et charger la page du profil
			$link = con();
	        $query = "SELECT id,mail,passwrd FROM users";
	        if ($result = mysqli_query($link, $query)) {
                while ($row = mysqli_fetch_assoc($result)) {
                	if($row["mail"] == $inputMail && $row["passwrd"] == $inputPassword) {
                		$_SESSION["connecte"] = "connecte";
                        $_SESSION["id"] = $row["id"];
                		header("Location:../");
                	}
                $validMail = "is-invalid";
                $validPassword = "is-invalid";
                $corres = "d-block";
                }
            }
            mysqli_close($link);
		}
	}
	?>
	<div class="row mw-100">
		<div class="col-sm"></div>
		<div class="col-md-4 m-4 bg-form">
			<h3 class="text-light mb-4 text-center">Connexion</h3>
			<?php include "form_connexion.php"; ?>
			<a href="#" class="text-secondary mt-3 float-right" role="button">Mot de passe oublié</a>
	  	</div>
	  	<div class="col-sm"></div>
	</div>
</body>
</html>