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
if (isset($_GET['id'])) {
    $id=$_GET['id'];
} else if(isset($_SESSION["id"])) {
    $id=$_SESSION["id"];
} else {
    header("Location:../");
}
?>

<?php include("../main_menu.php"); ?>

<?php
if (isset($_GET["r"])) {
    delfriends($_GET["id1"],$id);
} else { ?>
    <div class="form-group">
        <label for='titre'> Vous etes amis: </label>
    </div>
    <?php
    friendsconfirmed($id,$_GET["id1"]);
} ?>

<?php include("../main_menu_footer.php"); ?>

</body>
</html>


