<?php
if(isset($_GET["id"])) {
    $user_cible = getEmail($_GET["id"]);
} else {
    $user_cible = "";
}
if(isset($_GET["r"])) {
    if($_GET["r"] == 1) {
        $type = "checked";
    } else {
        $type = "";
    }
} else {
    $type = "";
}
if(isset($_GET["err"]) && $_GET["err"] == "user") {
    $erruser = "";
} else {
    $erruser = "d-none";
}
?>
<form class="container" method="POST" action="dette_ajoutee.php">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Type</label>
        <div class="form-inline col-sm-10">
            <label class="m-2" for="checkbox">Créance</label>
            <label class="switch">
                <input type="checkbox" id="checkbox" name="slider" value="dette" <?php echo $type ?>>
                <span class="slider" for="checkbox"></span>
            </label>
            <label class="m-2" for="checkbox">Dette</label>
        </div>
    </div>
    <div class="form-group row">
        <label for="Cible" class="col-sm-2 col-form-label">Utilisateur cible</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="Cible" placeholder="@mail cible" name="dst" required value="<?php echo $user_cible ?>">
        </div>
    </div>
    <div class="mb-3 <?php echo $erruser ?>">
        <p class="text-danger">L'utilisateur spécifié n'existe pas</p>
    </div>
    <div class="form-group row">
        <label for="montant" class="col-sm-2 col-form-label">Montant</label>
        <div class="col-sm-10">
            <input class="form-control" id="montant" placeholder="Montant (en euros)" name="montant" required>
        </div>
    </div>
    <div class="form-group">
        <label for="message1">Message d'explication</label>
        <textarea class="form-control" id="message1" rows="3" name="msg1" required></textarea>
        <div class="invalid-feedback">
            Veuillez entrer un message d'explication.
        </div>
    </div>
    <div class="form-group row">
        <label for="date1" class="col-sm-2 col-form-label">Date de création</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="date1" value="<?php echo date("Y-m-j")?>" name="date1" required>
        </div>
    </div>
    <div class="container w-25 m-auto">
        <button type="submit" name="submit" class="btn submit-btn w-100 mt-4 p-2"> Ajouter</button>
    </div>
</form>