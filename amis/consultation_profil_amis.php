<!-- AFFICHE LE NOM DE LA PERSONNE RECHERCHÉE -->

<div class="from-group">
    <div class="row mw-100">
        <div class="col-sm" ></div>
        <div class="col-md-4 m-4 bg-form">

            <?php

            if (isset($_POST["ami"])){
                $pseudo_ami = $_POST["ami"];
            } else if(isset($_GET["user"])) {
                $pseudo_ami = $_GET["user"];
            }

            $id_ami = findUser($pseudo_ami);
            $name = getName($id_ami);
            $prenom = getPrenom($id_ami);
            $Email = getEmail($id_ami);
            $age = getAge($id_ami);

            if($name == "NULL") {
                $prenom = $pseudo_ami;
                $name = "";
            }


            ?>

            <h5 class="text-center">La personne recherchée est la suivante : <?php echo "<br><br>".$prenom." ".$name ?></h5>

        </div>

        <div class="col-sm"></div>

    </div>
</div>
