<?php
if(!isset($_SESSION["id"])) {
    header("Location:index.php");
}
?>

<?php include("main_menu.php"); ?>

    <div class="row m-2">
        <div class="text-center">
            <h2>Créances</h2>
        </div>
    </div>

    <div class="row m-auto">
        <?php 
        include("dettes/affiche_dette.php"); 
        ?>
        <a href="dettes/ajouter.php" class="btn text-center ml-3 card-ask mt-3 text-light pt-4">
            <h4>Demander de l'argent</h4><br>
        </a>
    </div>
    <div class="row m-2 mt-5">
        <div class="text-center">
            <h2>Dettes</h2>
        </div>
    </div>
    <div class="row m-auto">
        <?php 
        include("dettes/affiche_dette_cible.php"); 
        ?>
        <a href="dettes/ajouter.php?r=1" class="btn text-center ml-3 card-ask mt-3 text-light pt-4">
            <h4>Envoyer de l'argent</h4><br>
        </a>
    </div>
                
<?php include("main_menu_footer.php"); ?>