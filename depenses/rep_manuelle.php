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


$debiteurs = getDebiteursFromDepense($_GET["id_d"]);
$err = "";

if (isset($_POST["submit"])){
    $somme = 0;
    foreach ($debiteurs as $id_deb){
        $somme += $_POST[getPseudo($id_deb[0])];
    }
    if($somme == getMontantFromDepense($_GET["id_d"])[0][0]) {
        foreach ($debiteurs as $id_deb){
            editCredit($_POST[getPseudo($id_deb[0])],$_GET["id_d"],$id_deb[0]);
        }
        header("Location: ../groupes/");
    } else {
        $err = "La somme des montants n'est pas égale à ".getMontantFromDepense($_GET["id_d"])[0][0];
    }
}

?>

<h4><?php echo getMontantFromDepense($_GET["id_d"])[0][0] ?> € à répartir pour la dépense <?php echo getTitleFromDepense($_GET["id_d"])["titre"] ?></h4>

<form class="container" method="POST" action="rep_manuelle.php<?php if(isset($_GET["id_d"])){?>?id_d=<?php echo $_GET["id_d"];}?>">

    <h5 class="mt-3 mb-3">Editer le montant pour chaque débiteur :</h5>
    <?php
    foreach ($debiteurs as $id_deb){
        ?>
        <div class="form-group row">
            <label for="pseudo" class="col-sm-2 col-form-label"><?php echo getPseudo($id_deb[0])?></label>
            <div class="col-sm-10">
                <input class="form-control" id="pseudo" placeholder="Montant (€)" name="<?php echo getPseudo($id_deb[0])?>" required>
            </div>
        </div>
        <?php
    }
    echo $err;
    ?>
    <div class="container w-25 m-auto">
        <button type="submit" name="submit" class="btn submit-btn w-100 mt-4 p-2">Valider</button>
    </div>
</form>


<?php
include("../main_menu_footer.php");
?>

</body>
</html>
