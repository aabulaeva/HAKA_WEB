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

if (isset($_POST["submit"])){
    if (isset($_POST["montant"])){
        $montant = $_POST["montant"];
    }
    if (isset($_POST["date"])){
        $date = $_POST["date"];
    }
    if (isset($_POST["titre"])){
        $titre = $_POST["titre"];
    }
    if (isset($_POST["pseudo"])){
        $pseudo = $_POST["pseudo"];
        $id = findUser($pseudo);
    } else {
        $id = $_SESSION["id"];
    }
    $id_depense = addDepense($_GET["id_group"], $id, $montant, $date, $titre);
    $i = 1;
    $nb_debiteurs = 0;
    $users = get_group_users($_GET["id_group"]);
    foreach ($users as $id_user){
        if (isset($_POST[$i])){
            $nb_debiteurs++;
        }
        $i++;
    }
    $i = 1;
    foreach ($users as $id_user){
        if (isset($_POST[$i])){
            addDebiteur($id_user[0], $id_depense, floor($montant/$nb_debiteurs));
        }
        $i++;
    }
    if(!isset($_POST["slider"])) {
        header("Location:../groupes/details.php?id=".$_GET["id_group"]);
    } else {
        header("Location:rep_manuelle.php?id_d=".$id_depense);
    }

}

?>

<form class="container" method="POST" action="ajouter_depenses.php<?php if(isset($_GET["id_group"])){?>?id_group=<?php echo $_GET["id_group"];}?>">

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Répartition</label>
        <div class="form-inline col-sm-10">
            <label class="m-2" for="checkbox">Égale</label>
            <label class="switch">
                <input type="checkbox" id="checkbox" name="slider" value="egale">
                <span class="slider"></span>
            </label>
            <label class="m-2" for="checkbox">Manuelle</label>
        </div>
    </div>
    <div class="form-group row">
        <label for="Titre" class="col-sm-2 col-form-label">Titre</label>
        <div class="col-sm-10">
            <input class="form-control" id="Titre" placeholder="Titre" name="titre" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="montant" class="col-sm-2 col-form-label">Montant</label>
        <div class="col-sm-10">
            <input class="form-control" id="montant" placeholder="Montant (en euros)" name="montant" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="date" class="col-sm-2 col-form-label">Date de création</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="date" value="<?php echo date("Y-m-j")?>" name="date" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="pseudo" class="col-sm-2 col-form-label">Créancier</label>
        <div class="col-sm-10">
            <select class="form-control" id="pseudo" name="pseudo">
                <?php
                $users = get_group_users($_GET["id_group"]);
                foreach ($users as $id_user){
                    $pseudo_user = getPseudo($id_user[0]);
                    ?>
                    <option value="<?php echo $pseudo_user?>"><?php echo $pseudo_user?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <h5 class="mt-5 mb-3">Ajouter des débiteurs :</h5>
    <?php
    $users = get_group_users($_GET["id_group"]);
    $i = 1;
    foreach ($users as $id_user){
        ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name=<?php echo $i;?>>
            <label class="form-check-label" for="defaultCheck1">
                <?php $pseudo_user = getPseudo($id_user[0]);
                echo $pseudo_user;
                ?>
            </label>
        </div>
        <?php
        $i++;
    }
    ?>
    <div class="container w-25 m-auto">
        <button type="submit" name="submit" class="btn submit-btn w-100 mt-4 p-2"> Ajouter</button>
    </div>
</form>


<?php
include("../main_menu_footer.php");
?>

</body>
</html>
