<?php
$dettes = getDettes($_SESSION["id"]);
foreach ($dettes as $dette){
    if (isOpen($dette["id"])) {
        if ($dette["id_cible"] == $_SESSION["id"]){
            $name = getPseudo($dette['id_source']);
            ?>
            <div class="text-left ml-3 card-receive mt-3 text-light">
                <h4><?php echo $name; ?></h4><br>
                <div class="mt-3 money">
                    <h2><?php echo $dette['montant']; ?> €</h2>
                    <a href="dettes/details.php?id=<?php echo $dette["id"]?>" class="btn details-btn float-right">Détails</a>
                </div>
            </div>
<?php
        }
    }
}
?>
