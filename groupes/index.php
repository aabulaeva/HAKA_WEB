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
} else {
    $id = $_SESSION["id"];
}
?>

<?php
include("../main_menu.php");

?>

<div class="row m-auto">
<a href="ajouter.php" class="btn text-center ml-3 card-add-group mt-3 pt-4">
    <h4>Créer un groupe</h4><br>
</a>
</div>

<?php

$groups = getIdGroupsFromUser($id);

?>

<div class="row m-auto">

<?php

foreach ($groups as $group) {
    $details = getGroupDetails($group[0]);
    ?>
    <div class="text-lg-left text-sm-center ml-3 card-detail-group mt-3 text-light">
        <h2><?php echo $details[0]["name_g"]; ?></h2><br>
        <h5><?php echo $details[0]["descr"]; ?></h5>
        <div>
            <a href="ajouter_util.php?id_g=<?php echo $group[0];?>" class="btn details-btn float-lg-right m-1">Ajouter un participant</a>
            <a href="../depenses/ajouter_depenses.php?id_group=<?php echo $group[0]?>" class="btn details-btn float-lg-right m-1">Ajouter une dépense</a>
            <a href="details.php?id=<?php echo $group[0];?>" class="btn details-plus-btn float-lg-right m-1">Details</a>
        </div>
    </div>
    <?php
}

?>


</div>

<?php
include("../main_menu_footer.php");
?>

</body>
</html>