<?php

    include("../functions.php");
    sessionRequest();

if(!isset($_SESSION["id"])) {
    header("Location:../index.php");
} else {
    $id_user = $_SESSION["id"];
}

if (isset($_POST["submit"])){
    if (isset($_POST["name"])){
        ?>
        <h4><?php echo $_POST["name"]; ?></h4>
        <?php

        $name = $_POST["name"];
    }
    if (isset($_POST["description"])){
        $description = $_POST["description"];
    }

    if (!empty($name) && !empty($description)){
        addGroup($name, $description, $id_user);
        $id_g = getGroupId($name)["id"];
        addUserToGroup($id_user, $id_g);
    }

    header("Location:ajouter_util.php?id_g=".$id_g);

}

