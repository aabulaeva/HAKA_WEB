<?php
if(substr_count($_SERVER['REQUEST_URI'],"/") == 2) {
    $path = "./";
} else if(substr_count($_SERVER['REQUEST_URI'],"/") == 3) {
    $path = "../";
} else if(substr_count($_SERVER['REQUEST_URI'],"/") == 4) {
    $path = "../../";
}
?>
<div class="container-fluid">
    <div class="row m-0">
        <div class="col-lg-2 col-md-3 col-left h-100">
            <div class="m-xl-4 mt-4">
                <a href="<?php echo $path; ?>" class="btn btn-block btn-brand mb-5"><img src="<?php echo $path ?>haka.png" width="130" alt="logo"></a>
            </div>
            <div class="m-4">
                <a href="<?php echo $path."dettes/"; ?>" class="btn btn-outline-primary btn-block">Historique</a>
            </div>
            <div class="m-4">
                <a href="<?php echo $path."profil/"; ?>" class="btn btn-outline-primary btn-block">Profil</a>
            </div>
            <div class="m-4">
                <a href="<?php echo $path."amis/"; ?>" class="btn btn-outline-primary btn-block">Amis</a>
            </div>
            <div class="m-4">
                <a href="<?php echo $path."groupes/"; ?>" class="btn btn-outline-primary btn-block">Groupes</a>
            </div>

            <hr class="bg-secondary w-75">

            <div class="mt-2 text-center">
                Solde
            </div>


            <div class="container">

                <div class="row text-center">

                    <div class="col mt-2 ml-md-3 mr-md-3 btn solde-dette">
                        + <?php echo getSoldeCreance($_SESSION["id"]); ?>
                    </div>

                </div>
                <div class="row">

                    <div class="col mt-2 ml-md-3 mr-md-3 btn solde-creance">
                        - <?php echo getSoldeDette($_SESSION["id"]); ?>
                    </div>
                </div>

                <hr class="bg-secondary w-25 mb-1">
                <hr class="bg-secondary w-25 mt-0">

                <div class="row">

                    <div class="col ml-md-3 mr-md-3 btn solde-total">
                        <?php
                        $solde = getSoldeCreance($_SESSION["id"]) - getSoldeDette($_SESSION["id"]);
                        if($solde > 0) {
                            echo "+ ".$solde;
                        } else {
                            echo "- ".abs($solde);
                        }
                         ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-10 col-md-9 p-0">
            <div class="col-right w-100">
                <?php
                include($path.'navbar.php');
                ?>
                <section class="container p-md-5 p-sm-0">
