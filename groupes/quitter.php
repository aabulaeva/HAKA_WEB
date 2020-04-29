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

if(isset($_POST["oui"])) {
    if($data[0]["admin"] == $_SESSION["id"]) {
        delGroup($_GET["id"]);
    } else {
        delGroupUser($_SESSION["id"], $_GET["id"]);
    }
    header("Location:../groupes/");
} else if(isset($_POST["non"])) {
    header("Location:details.php?id=".$_GET["id"]);
}



include("../main_menu.php");

?>


<h3>Êtes vous sûr de vouloir quitter le groupe <?php echo $data[0]["name_g"]?> ?</h3>

<div class="row">
    <form method="POST">
        <button type="submit" name="oui" class="btn submit-btn">Oui</button>
        <button type="submit" name="non" class="btn submit-btn">Non</button>
    </form>
</div>

<?php
include("../main_menu_footer.php");
?>

</body>
</html>