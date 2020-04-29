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

if (isset($_SESSION["id"])){
    $id_user = $_SESSION["id"];
}

if (isset($_GET["id_g"])){
    $id_group = $_GET["id_g"];
}
include("../main_menu.php");

?>

<div class="row m-2 mb-4">
    <div class="text-center">
        <h3>Ajouter des participants au groupe <?php echo getGroupName($id_group)['name_g'];?></h3>
    </div>
</div>
<form method="POST" action="ajouter_util.php?id_g=<?php echo $id_group;?>">
    <div class="row">
        <input type="text" class="form-control col ml-4 mr-3" placeholder="Pseudo" name="pseudo">
        <button type="submit" name="rechercher" class="btn search-btn col-md-2 ml-4 mr-3">Rechercher</button>
        <span class="col-lg-5 col-sm-0"></span>
    </div>
    <button type="submit" name="carnet_d_amis" class="btn m-3">Ajouter à partir du carnet d'amis</button>
</form>
<?php
if (isset($_POST["rechercher"]) && $_POST["pseudo"] != "") {
    userFound($_POST["pseudo"]);
    $id = findUser($_POST["pseudo"]);
    addUserToGroup($id, $id_group);
}
?>
<form method="POST" action="add_user.php">
    <input name="id_g" value="<?php echo $id_group ?>" type="hidden">
    <?php

    if (isset($_POST['carnet_d_amis'])){
        if (isset($id_user)){
            $friends_id = getFriends($id_user);
            $i = 1;
            foreach ($friends_id as $id_friend){
                if ($id_user != $id_friend["id_2"] && $id_friend["etat"] == 2){?>
                    <div class="form-check m-3">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="<?php echo $i;?>">
                        <label class="form-check-label" for="defaultCheck1">
                            <?php $pseudoamis = getPseudo($id_friend["id_2"]);
                            echo $pseudoamis;
                            ?>
                        </label>
                    </div>
                    <?php
                    $i++;
                }
                if ($id_user != $id_friend["id_1"] && $id_friend["etat"] == 2){?>
                    <div class="form-check m-3">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="<?php echo $i;?>">
                        <label class="form-check-label" for="defaultCheck1">
                            <?php $pseudoamis = getPseudo($id_friend["id_1"]);
                            echo $pseudoamis;
                            ?>
                        </label>
                    </div>
                    <?php
                    $i++;
                }
            }
        }
    }
    ?>
    <div class="container w-25 m-auto">
        <button type="submit" name="submit2" class="btn submit-btn w-100 mt-4 p-2">Ajouter</button>
    </div>
</form>

<?php
include("../main_menu_footer.php");
?>

</body>
</html>

