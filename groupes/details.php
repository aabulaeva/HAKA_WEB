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
    $data = getGroupDetails($_GET['id']);
    $idusers = get_group_users($_GET['id']);
    $i = 0;
    foreach ($idusers as $iduser) {
        if($iduser[0] == $_SESSION["id"]) {
            $i = 1;
        }
    }
    if($i == 0) {
        header("Location:../");
    }
}
?>

<?php

include("../main_menu.php");
include("details_groupe.php");
include("../main_menu_footer.php");
?>

</body>
</html>