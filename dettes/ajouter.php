<!doctype html>
<html lang="fr">
<head>
    <?php 
    include '../head.php'; 
    include_once '../functions.php';
    sessionRequest();
    ?>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    <?php
    if(!isset($_SESSION["id"])) {
        header("Location:../");
    }
    include("../main_menu.php");
    include("ajouter_dette.php");
    include("../main_menu_footer.php");
    ?>
</body>
</html> 