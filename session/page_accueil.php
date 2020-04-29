<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?php
    include('../head.php');
    include('../functions.php');
    session_start();
    ?>

    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Page d'accueil HAKA</title>
  </head>
  <body>

    <div class="container mt-4">

    <div class="row mw-100">
        <div class="col-sm"></div>
        <div class="col-sm text-center mb-4">
            <img src="../haka.png" width="250">
        </div>
        <div class="col-sm"></div>


    </div>

    <div class="row mw-100">
      <div class="col-sm"></div>
      <div class="col-sm">
      <h3 class="text-black mb-4 text-center">Bienvenue sur Debster !</h3>
      <p class="text-center">Debster est un site qui te permets de régler tes comptes avec tes amis !
Tu peux ajouter des amis et tenir à jour l'argent que l'on te doit ou que tu dois !
      </p>
    </div>
      <div class="col-sm"></div>
    </div>

    <div class="row mw-100">
      <div class="col-sm"></div>
      <div class="col-sm">

        <div class="row mw-100">
        <a href="connexion.php" class="btn submit-btn w-100 mt-4 p-2" style="border-radius: 20px;">Je suis déjà membre</a>
        </div>

      </div>

      <div class="col-sm">
        <a href="page_enregistrement.php" class="btn submit-btn w-100 mt-4 p-2" style="border-radius: 20px;">Je m'enregistre !</a>
      </div>
      <div class="col-sm"></div>
    </div>
  </div>
  </body>
</html>
