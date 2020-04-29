<?php

/** @var $data = details_dette($_GET['id']) */
if($data[0]["id_cible"] == $_SESSION["id"]) {
    $type = "creance";
    $card = "card-detail-receive";
} else {
    $type = "dette";
    $card = "card-detail-pay";
}
?>

<div class="container ml-md-3 <?php echo $card ?> mt-3 text-light">

    <?php

    if($type == "dette") {
        if($data[0]['statut'] == "1") {
            ?> <h3 class="text-center">Vous devez à <?php echo getPseudo($data[0]["id_cible"]) ?></h3>
            <?php
        } else {
            ?> <h3 class="text-center">Vous deviez à <?php echo getPseudo($data[0]["id_cible"]) ?></h3>
            <?php
        }
    } else {
        if($data[0]['statut'] == "1") {
            ?> <h3 class="text-center"><?php echo getPseudo($data[0]["id_source"]) ?> vous doit</h3>
            <?php
        } else {
            ?> <h3 class="text-center"><?php echo getPseudo($data[0]["id_source"]) ?> vous devait</h3>
            <?php
        }
    }
    ?>

    <div class="mt-3 money text-center">
        <h1><?php echo $data[0]['montant']; ?> €</h1>
    </div>

    <?php
    if(isset($_POST["edit_montant"])) {
        ?>
        <form method="POST" class="mt-4 mb-4 text-center">
            <div class="form-group row">
                <label for="1" class="col-form-label ml-3">Nouveau montant</label>
                <div class="col-sm-10">
                    <input class="form-control mr-lg-5" id="1" name="montant" value="<?php echo $data[0]['montant'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" name="submit-m" class="btn btn-submit"> Valider </button>
                    <button type="submit" name="cancel" class="btn btn-submit"> Annuler </button>
                </div>
            </div>
        </form>
        <?php
    } else if(isset($_GET['id']) && isset($_POST["submit-m"]) && isset($_POST["montant"]) && $_POST["montant"] != 0){
        editMontant($_GET['id'], $_POST["montant"]);
        header("Location:?id=".$data[0]['id']);
    } else if($data[0]['statut'] == "1") {
        ?>
        <form method="POST" class="mt-4 text-center">
            <button type="submit" name="edit_montant" class="btn card-link">Éditer le montant</button>
        </form>
        <?php
    }
    ?>

    <div class="card-message mt-3 mb-3 p-3">
        <h5 class="text-secondary">Message :</h5>
        <?php echo $data[0]['msg_expl']; ?>
    </div>

    <div class="card-status mt-3 mb-3 p-3">
        <?php
        if($type == "dette") {
            ?>
            <h5>Dette créée le <?php echo $data[0]['date_creation'] ?></h5>
            <?php
        } else {
            ?>
            <h5>Créance créée le <?php echo $data[0]['date_creation'] ?></h5>
            <?php
        }
        ?>

    </div>

    <div class="card-status mt-3 mb-3 p-3">
        <?php
        if($data[0]['statut'] == "1") {
            ?>
            <h5>Status : ouverte</h5>
            <?php
        } else if($data[0]['statut'] == "2") {
            ?>
            <h5>Status : remboursée</h5>
            <?php
        } else {
            ?>
            <h5>Status : annulée</h5>
            <?php
        }
        ?>

    </div>


    <?php
    if ($data[0]['statut'] != "1"){

        ?>

        <div class="card-status mt-3 mb-3 p-3">
            <?php
            if($data[0]['statut'] == "0") {
                ?>
                <h5>Date de fermeture : <?php echo $data[0]['date_ferm']?></h5>
                <h5>Message de fermeture : <?php echo $data[0]['msg_ferm']?></h5>
                <?php
            } else if($data[0]['statut'] == "2") {
                ?>
                <h5>Date de remboursement : <?php echo $data[0]['date_ferm']?></h5>
                <h5>Message de remboursement : <?php echo $data[0]['msg_ferm']?></h5>
                <?php
            }
            ?>

        </div>

        <?php

    } else {

        ?>

        <div class="container text-center">

            <?php

            if(isset($_POST["annuler"])) {
                ?>
                <form method="POST" class="mt-4 mb-4">
                    <div class="form-group row">
                        <label for="1" class="col-form-label ml-3">Message de fermeture</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="1" name="message">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="submit-f" class="btn btn-submit"> Valider l'annulation </button>
                            <button type="submit" name="cancel" class="btn btn-submit"> Annuler </button>
                        </div>
                    </div>
                </form>
                <?php
            } else if(isset($_GET['id']) && isset($_POST["submit-f"]) && isset($_POST["message"]) && sizeof($_POST["message"]) != 0){
                closeDette($_GET['id'], "0", $_POST["message"]);
                header("Refresh:0");
            } else if(!isset($_POST["rembourser"])) {
                ?>
                <form method="POST" class="mt-4 d-inline">
                    <button type="submit" name="annuler" class="btn card-link">Annuler la <?php echo $type == "dette"?"dette":"créance" ?></button>
                </form>
                <?php
            }

            if(isset($_POST["rembourser"])) {
                ?>
                <form method="POST" class="mt-4 mb-4">
                    <div class="form-group row">
                        <label for="1" class="col-form-label ml-3">Message de fermeture</label>
                        <div class="col-sm-10">
                            <input class="form-control mr-lg-5" id="1" name="message">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="submit-r" class="btn btn-submit"> Valider le remboursement </button>
                            <button type="submit" name="cancel" class="btn btn-submit"> Annuler </button>
                        </div>
                    </div>
                </form>
                <?php
            } else if(isset($_GET['id']) && isset($_POST["submit-r"]) && isset($_POST["message"]) && sizeof($_POST["message"]) != 0){
                closeDette($_GET['id'], "2", $_POST["message"]);
                header("Refresh:0");
            } else if(!isset($_POST["annuler"])) {
                ?>
                <form method="POST" class="ml-4 d-inline">
                    <button type="submit" name="rembourser" class="btn card-link">Rembourser la <?php echo $type == "dette"?"dette":"créance" ?></button>
                </form>
                <?php
            }

            ?>

        </div>

        <?php

    }

    ?>

</div>

