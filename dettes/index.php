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
    header("Location:../index.php");
}
?>

<?php
include("../main_menu.php");
?>

<div class="row m-2">
    <div class="text-center">
        <h2>Dettes</h2>
    </div>
</div>

<div class="row">
    <div class="col"></div>
    <div class="col-0 col-center-top"><span></span></div>
    <div class="col"></div>
</div>

<?php
$dettes = getDettes($_SESSION["id"]);
foreach ($dettes as $dette) {
    if($dette["statut"] == "1") {
        $statut = "Ouverte";
    } else if($dette["statut"] == "0") {
        $statut = "Annulée";
    } else {
        $statut = "Remboursée";
    }
    ?>

    <div class="row">

        <div class="col align-middle">
            <?php
            if ($dette["id_cible"] == $_SESSION["id"]) {
                $name = getPseudo($dette['id_source']);
                ?>
                <div class="text-left ml-lg-5 mr-0 card-receive mt-3 text-light w-auto">
                    <h4><?php echo $name; ?></h4>
                    <h5 class="float-right"><?php echo $statut; ?></h5><br>
                    <div class="mt-3 money">
                        <h2><?php echo $dette['montant']; ?> €</h2>
                        <a href="details.php?id=<?php echo $dette["id"] ?>" class="btn details-btn float-right">Détails</a>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <div class="text-right ml-lg-5 mr-0 mt-5 w-auto">
                    <h6 class="card-date p-3 mr-3"><?php echo $dette["date_creation"]; ?></h6>
                </div>
                <?php
            }
            ?>

        </div>

        <div class="col-0 col-center"><span></span></div>

        <div class="col align-middle">
            <?php
            if ($dette["id_source"] == $_SESSION["id"]) {
                $name = getPseudo($dette['id_cible']);
                ?>
                <div class="text-left ml-0 mr-lg-5 card-pay mt-3 text-light w-auto">
                    <h4><?php echo $name; ?></h4>
                    <h5 class="float-right"><?php echo $statut; ?></h5><br>
                    <div class="mt-3 money">
                        <h2><?php echo $dette['montant']; ?> €</h2>
                        <a href="details.php?id=<?php echo $dette["id"] ?>" class="btn details-btn float-right">Détails</a>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <div class="text-left ml-0 mr-lg-5 mt-5 w-auto">
                    <h6 class="card-date-right p-3 ml-3"><?php echo $dette["date_creation"]; ?></h6>
                </div>
                <?php
            }
            ?>

        </div>

    </div>

    <?php
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col-0 col-center-bottom"><span></span></div>
    <div class="col"></div>
</div>

<?php

include("../main_menu_footer.php");
?>

</body>
</html>