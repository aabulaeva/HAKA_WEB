<!doctype html>
<html lang="fr">
<head>
    <?php 
    include('../head.php'); 
    include('../functions.php');
    sessionRequest();
    ?>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    
    <?php
    if(!isset($_SESSION["id"])) {
        header("Location:../");
    }
    if (isset($_GET['id'])){
        $data = getDetteDetails($_GET['id']);
    }

    include("../main_menu.php");
    include("details_dette.php");
    include("../main_menu_footer.php");
    ?>

</body>
</html> 