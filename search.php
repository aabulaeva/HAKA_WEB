<!doctype html>
<html lang="fr">
<head>
    <?php
    include("functions.php");
    include("head.php");
    sessionRequest();
    ?>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
if(isset($_SESSION["id"])) {
    $id=$_SESSION["id"];
} else {
    header("Location:../");
}
?>

<?php include("main_menu.php"); ?>

<?php
if(isset($_GET["user"])) {
    include("amis/consultation_profil_amis.php");
} else if(isset($_GET["id"])) {
    include("groupes/details.php");
}
?>

<?php include("main_menu_footer.php"); ?>

</body>
</html>
