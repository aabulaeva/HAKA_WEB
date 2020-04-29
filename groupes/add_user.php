<?php
include("../functions.php");
sessionRequest();

if (isset($_SESSION["id"])){
    $id_user = $_SESSION["id"];
} else {
    header("Location:../");
}

if(isset($_POST["id_g"])){
    $id_g = $_POST["id_g"];
} else{
    header("Location:groupe_ajouté.php");
}

if (isset($_POST["submit2"])){
    $friends_id = getFriends($id_user);
    $i = 1;
    foreach ($friends_id as $id_friend){
        if (isset($_POST[$i])){
            if($id_user == $id_friend["id_1"]) {
                addUserToGroup($id_friend["id_2"], $id_g);
            } else {
                addUserToGroup($id_friend["id_1"], $id_g);
            }
        }
        if (isset($_POST[$i+1])){
            $i++;
        }
    }

    header("Location:details.php?id=".$id_g);
} else {
    header("Location:details.php?id=".$id_g);
}