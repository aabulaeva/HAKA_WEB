<?php

/** @var $data = getGroupDetails($_GET['id']) */
if($data[0]["admin"] == $_SESSION["id"]) {
    $admin = 0;
    $exit = "Supprimer le groupe";
} else {
    $admin = $data[0]["admin"];
    $exit = "Quitter le groupe";
}

?>

<div class="container ml-md-3 card-detail-group mt-3 text-light">

    <h3 class="text-center"><?php echo $data[0]["name_g"]?></h3>

    <div class="card-message mt-3 mb-3 p-3">
        <h5 class="text-secondary">Administrateur :</h5>
        <?php echo $admin==0?"Vous êtes l'administrateur de ce groupe":getPrenom($admin)." ".getName($admin)?>
        <h5 class="text-secondary mt-2">Description :</h5>
        <?php echo $data[0]["descr"]?>
    </div>

    <div class="card-status mt-3 mb-3 p-3">
        <div class="row m-auto">
            <h5 class="text-secondary">Membres : </h5>
            <a href="ajouter_util.php?id_g=<?php echo $data[0]["id"];?>" class="btn plus-btn">+</a>
        </div>


        <?php
        /** @var $idusers = get_group_users */
        foreach ($idusers as $iduser) {
            ?>
            <div class="row text-lg-left text-sm-center ml-3 mt-3 text-light">

                <h5 class="col"><?php
                    if(getPrenom($iduser[0]) == "NULL") {
                        echo getPseudo($iduser[0]);
                    } else {
                        echo getPrenom($iduser[0])." ".getName($iduser[0]);
                    }
                    ?></h5>
                <?php
                if($admin == 0 && $iduser[0] != $_SESSION["id"]) {
                    ?>
                    <a href="supprimer.php?id_u=<?php echo $iduser[0]?>&id_g=<?php echo $_GET['id']?>" class="col-md-5 btn mr-3">Supprimer du groupe</a>
                    <?php
                }
                ?>

            </div>
            <?php
        }
        ?>
    </div>


    <h3 class="text-secondary">Dépenses du groupe :</h3>
    <?php
    $depenses = getGroupDepenses($_GET['id']);
    foreach ($depenses as $dep){
        $titre = getTitleFromDepense($dep["id"]);
        $creancier = getCreancierFromDepense($dep["id"]);

        ?>
        <div class="card-message mt-3 mb-3 p-3">
            <h5 class="text-secondary">Titre :</h5>
            <h5 class="col"><?php echo $titre["titre"]; ?></h5>
            <h5 class="text-secondary">Créancier :</h5>
            <h5 class="col">
                <?php
                if(getPrenom($creancier[0][0]) == "NULL") {
                    echo getPseudo($creancier[0][0]);
                } else {
                    echo getPrenom($creancier[0][0])." ".getName($creancier[0][0]);
                }?>
            </h5>
            <h5 class="text-secondary">Montant :</h5>
            <?php
            ?>
            <h5 class="col"><?php echo getMontantFromDepense($dep["id"])[0][0] ." €"; ?></h5>
            <h5 class="text-secondary">Débiteurs :</h5>
            <?php
            $debiteurs = getDebiteursFromDepense($dep["id"]);
            foreach ($debiteurs as $id_deb){
                $credit = getDebiteurCredit($id_deb[0], $dep["id"]);
                ?>
                <div class="row ml-1">
                    <h5 class="col"><?php
                        if(getPrenom($id_deb[0]) == "NULL") {
                            echo getPseudo($id_deb[0]);
                        } else {
                            echo getPrenom($id_deb[0])." ".getName($id_deb[0]);
                        }
                        ?></h5>
                    <h5 class="col"><?php echo $credit["credit"]." €" ?></h5>
                </div>
                <hr class="bg-dark m-0 mb-2">
                <?php
            }
            ?>
        </div>

        <?php
    }
    ?>

    <div class="row ml-2">
        <a href="../depenses/ajouter_depenses.php?id_group=<?php echo $_GET['id']; ?>" class="btn m-2">Nouvelle dépense</a>
        <a href="encours_groupe.php?id_group=<?php echo $_GET['id']; ?>" class="btn m-2">Encours de groupe</a>
        <a href="quitter.php?id=<?php echo $_GET['id']; ?>" class="btn m-2 exit"><?php echo $exit?></a>
    </div>

</div>


