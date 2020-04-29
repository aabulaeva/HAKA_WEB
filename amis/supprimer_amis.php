<?php
include("../functions.php");
if(isset($_GET["id1"]) && isset($_GET["id2"])) {
    delfriends($_GET["id1"],$_GET["id2"]);
    header("Location:./");
}
?>