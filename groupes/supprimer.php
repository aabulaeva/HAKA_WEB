<?php
include("../functions.php");
if(!isset($_GET["id_u"]) || !isset($_GET["id_g"])) {
    header("Location:../groupes/");
} else {
    delGroupUser($_GET["id_u"],$_GET["id_g"]);
    header("Location:details.php?id=".$_GET["id_g"]);
}