<!doctype html>
<html lang="fr">
<head>
    <?php 
      include("../functions.php");
      include("../head.php");
      sessionRequest();
      ?>
      <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
    
    <?php
    if(!isset($_SESSION["id"])) {
        header("Location:../index.php");
    }
    ?>

    <?php 
    include("../main_menu.php");
    include("ajouter_groupe.php"); 
    include("../main_menu_footer.php");
    ?>

</body>
</html> 