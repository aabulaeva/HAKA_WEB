<?php
if(substr_count($_SERVER['REQUEST_URI'],"/") == 2) {
    $path = "./";
} else if(substr_count($_SERVER['REQUEST_URI'],"/") == 3) {
    $path = "../";
} else if(substr_count($_SERVER['REQUEST_URI'],"/") == 4) {
    $path = "../../";
}

if(getFriendRequestNb($_SESSION["id"]) != 0) {
    $notif_img = $path."notification_notify.png";
} else {
    $notif_img = $path."notification.png";
}

if(isset($_POST["search"])) {
    $search = $_POST["search"];
    if(getIdFromPseudo($search)) {
        header("Location:".$path."search.php?user=".$search);
    } else if(getGroupId($search)) {
        header("Location:".$path."groupes/details.php?id=".strval(getGroupId($search)['id']));
    }
}

?>
<div class="navbar">
    <form method="POST">
        <div class="form-group m-2">
            <div class="col">
                <input type="text" name="search" class="form-control nav-search" id="search" placeholder= "Rechercher un ami, un groupe..." >
            </div>
        </div>
    </form>
    <span></span>
    <div class="float-right">
        <a href="<?php echo $path."notifications/"; ?>" class="btn nav-btn m-2"><img src="<?php echo $notif_img; ?>" alt="notif"></a>
        <a href="<?php echo $path; ?>" class="btn nav-btn m-2">Tableau de bord</a>
        <a href="<?php echo $path."session/deco.php"; ?>" class="btn nav-btn m-2">Déconnexion</a>
    </div>
</div>