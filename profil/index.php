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

<?php include("../main_menu.php"); ?>

<?php

if(isset($_SESSION["id"])) {
    $id=$_SESSION['id'];
} else {
    header("Location:../");
}
?>

<div>
    <h5 class="mt-3 mb-2">Pseudo : </h5>

    <?php
    echo getPseudo($id);
    ?>
</div>

<div>
    <h5 class="mt-3 mb-2">Nom : </h5>

    <?php
    echo getName($id);
    ?>
</div>

<div>
    <h5 class="mt-3 mb-2">Prénom : </h5>

    <?php
    echo getPrenom($id);
    ?>
</div>
<div>
    <h5 class="mt-3 mb-2">Mail : </h5>

    <?php
    echo getEmail($id);
    ?>
</div>
<div>
    <h5 class="mt-3 mb-2">Age : </h5>

    <?php
    echo getAge($id);
    ?>
</div>


<?php include("../main_menu_footer.php"); ?>

</body>
</html>
