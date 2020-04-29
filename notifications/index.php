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
if(isset($_SESSION["id"])) {
    $id=$_SESSION["id"];
} else {
    header("Location:../");
}
?>

<?php include("../main_menu.php"); ?>

<div class="row m-2 mb-5">
    <div class="text-center">
        <h2>Notifications</h2>
    </div>
</div>
<?php
if($ent=getFriendRequest($id)){
    foreach ($ent as $id_friend){
        $pseudoamis = getPseudo($id_friend["id_1"]);
        ?>
        <div class="row m-3 w-50 card-detail-group">
            <div class="col-2 m-auto">
                <?php echo $pseudoamis ?>
            </div>
            <div class="col-2 m-auto">
                <a href="vousetesamis.php?id1=<?php echo $id_friend["id_1"] ?>" class="btn btn-outline-primary">Accepter</a>
            </div>
            <div class="col-2 m-auto">
                <a href="vousetesamis.php?r=0&id1=<?php echo $id_friend["id_1"] ?>" class="btn btn-outline-primary">Refuser</a>
            </div>
        </div>
        <?php
    }
}
?>

<?php include("../main_menu_footer.php"); ?>

</body>
</html>

