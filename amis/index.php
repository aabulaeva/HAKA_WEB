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

<form method="post">
    <div class="form-group row ml-1">
        <label class="col-form-label" for="search">Ajouter un ami</label>
        <div class="col">
            <input type="text" name="ami" class="form-control" id="search" placeholder= "Rechercher quelqu'un" >
        </div>
    </div>
</form>
<div class="row ml-1 mb-4">
    <?php
    if (isset($_POST['ajouter']) && isset($_POST['ami'])) {
        $ami=$_POST['ami'];
        $i=getIdFromPseudo($ami);
        if ($i != NULL) {
            $ret = createFriendship($_SESSION["id"], $i);
            if($ret == 1) {
                ?>
                <h5 class="text-warning">Vous êtes déjà amis</h5>
                <?php
            } else if($ret == 2) {
                ?>
                <h5 class="text-warnig">Demande déjà envoyée</h5>
                <?php
            } else if($ret == 0) {
                ?>
                <h5 class="text-succes">Demande envoyée</h5>
                <?php
            }
            else if($ret == 3) {
                ?>
                <h5 class="text-warning">Vous ne pouvez pas vous demander en amis</h5>
                <?php
            }
        }
    }
    ?>
</div>
<?php
if(isset($_POST["ami"])) {
    ?>
    <div class="col-md-4 m-4 mb-1 bg-form">
        <?php
        $pseudo_ami = $_POST["ami"];
        $id_ami = findUser($pseudo_ami);
        $name = getName($id_ami);
        $prenom = getPrenom($id_ami);
        $Email = getEmail($id_ami);
        $age = getAge($id_ami);
        ?>
        <h3 class="text-black mb-4 text-center">Personne recherchée :</h3>
        <h6 class="text-center"><?php echo $prenom." ".$name; ?></h6>
        <form method="POST" class="text-center mt-4">
            <input type="text" name="ami" class="form-control" id="search" value="<?php echo $pseudo_ami ?>" hidden>
            <button type="submit" name="ajouter" class="btn submit-btn">Ajouter</button>
        </form>
    </div>
    <?php
}
?>
<div class="from-group">
    <div class="row mw-100">
        <div class="col-sm" >
            <div class="row m-2 mb-5">
                <div class="text-center">
                    <h2>Amis</h2>
                </div>
            </div>
            <?php
            $ent = getFriends($id);
            foreach ($ent as $id_friend){
                $pseudoamis = getPseudo($id_friend["id_2"]);
                if ($id != $id_friend["id_2"] && $id_friend["etat"]==2 ){
                    $pseudoamis = getPseudo($id_friend["id_2"]);
                    ?>
                    <div class="row m-1 mr-5">
                        <div class="col m-auto">
                            <h3 class="text-light"><?php echo $pseudoamis;?></h3>
                        </div>
                        <div class="col m-auto">
                            <a href="../dettes/ajouter.php?id=<?php echo $id_friend["id_2"] ?>&r=0" class="btn btn-outline-primary btn-block">Demander de l'argent</a>
                        </div>
                        <div class="col m-auto">
                            <a href="../dettes/ajouter.php?id=<?php echo $id_friend["id_2"] ?>&r=1 " class="btn btn-outline-primary btn-block">Envoyer de l'argent</a>
                        </div>
                        <div class="col m-auto">
                            <a href="supprimer_amis.php?id2=<?php echo $id_friend["id_2"] ?>&id1=<?php echo $id_friend["id_1"]?>" class="btn btn-outline-primary btn-block">Supprimer l'ami</a>
                        </div>
                    </div>
                    <hr class="mr-5 ml-3 bg-secondary"/> <?php
                }
                if ($id != $id_friend["id_1"] && $id_friend["etat"]==2)  {
                    $pseudoamis = getPseudo($id_friend["id_1"]);
                    ?>
                    <div class="row m-1 mr-5">
                        <div class="col m-auto">
                            <h3 class="text-light"><?php echo $pseudoamis;?></h3>
                        </div>
                        <div class="col">
                            <a href="../dettes/ajouter.php?id=<?php echo $id_friend["id_1"] ?>&r=0" class="btn btn-outline-primary btn-block">demander de l'argent</a>
                        </div>
                        <div class="col">
                            <a href="../dettes/ajouter.php?id=<?php echo $id_friend["id_1"] ?>&r=1" class="btn btn-outline-primary btn-block">envoyer de l'argent</a>
                        </div>
                        <div class="col m-auto">
                            <a href="supprimer_amis.php?id2=<?php echo $id_friend["id_2"] ?>&id1=<?php echo $id_friend["id_1"]?>" class="btn btn-outline-primary btn-block">Supprimer l'ami</a>
                        </div>
                    </div>
                    <hr class="mr-5 ml-3 bg-secondary"/> <?php
                }

            }
            ?>
        </div>
    </div>
</div>
<?php include("../main_menu_footer.php"); ?>
</body>
</html>
