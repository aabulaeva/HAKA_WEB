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

$id_group = $_GET["id_group"];
$users = get_group_users($_GET["id_group"]);
$credit = 0;
$depenses = getGroupDepenses($_GET['id_group']);


?>

<div class="row m-2 mb-4">
    <div class="text-center">
        <h2>Encours du groupe <?php echo getGroupName($id_group)["name_g"] ?></h2>
    </div>
</div>

<div class="row m-auto">
    <?php
    foreach($users as $user){
        ?>
        <div class="text-center p-3 ml-3 card-message text-light">
            <?php
            echo getPseudo($user[0]);
            $credit = 0;
            foreach ($depenses as $dep){
                $credit = $credit + getMemberCredit($user[0], $dep["id"])["credit"];
            }
            $creance = getMemberCreance($user[0], $id_group);
            $creance = ($creance[0][0] == ""?"0":$creance[0][0])
            ?>
            <div class="col mt-2 btn solde-dette">
                <?php echo "+ ". $creance; ?>
            </div>
            <div class="col mt-2 btn solde-creance">
                <?php echo "- " .$credit; ?>
            </div>
            <hr class="bg-secondary w-25 mb-1">
            <hr class="bg-secondary w-25 mt-0">

            <div class="col btn solde-total">
                <?php
                $solde = $creance - $credit;
                if($solde > 0) {
                    echo "+ ".$solde;
                } else {
                    echo "- ".abs($solde);
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<?php
include("../main_menu_footer.php");
?>

</body>
</html>