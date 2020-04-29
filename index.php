<!doctype html>
<html lang="fr">
<head>
    <?php 
    include 'head.php'; 
    include 'functions.php';
    sessionRequest();
    ?>
</head>
<body>
    
    <?php
    if(isset($_SESSION["connecte"]) && $_SESSION["connecte"] == "connecte") {
        include("index_connecte.php");
    } else {
        header("Location:session/page_accueil.php");
    }
    ?>

</body>
</html> 