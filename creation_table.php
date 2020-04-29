<?php

    $link = mysqli_connect($dbhost, $dbuser, $dbpass,"HAKA");

    //table utilisateurs
    mysqli_query($link, "CREATE TABLE users (id INT PRIMARY KEY AUTO_INCREMENT, mail VARCHAR(250) NOT NULL, passwrd VARCHAR(200) NOT NULL, f_name VARCHAR(250) NOT NULL, l_name VARCHAR(250) NOT NULL, age INT NOT NULL, pseudo VARCHAR(250) NOT NULL);");
    echo "la table users est crée";
    echo "<br/>";
    //table amis
    mysqli_query($link, "CREATE TABLE friends (id_1 INT, FOREIGN KEY (id_1) REFERENCES users(id), id_2 INT, FOREIGN KEY (id_2) REFERENCES users(id),etat INT NOT NULL);");
    echo "la table friends est crée";
    echo "<br/>";

    //table group
    mysqli_query($link, "CREATE TABLE groups(id INT PRIMARY KEY AUTO_INCREMENT, name_g VARCHAR(250), descr VARCHAR(250), admin INT, FOREIGN KEY(admin) REFERENCES users(id));");
    echo "la table groups est crée";
    echo "<br/>";

    //table d'association utilisateurs_groupes
    mysqli_query($link, "CREATE TABLE user_for_group( id_u INT, FOREIGN KEY (id_u) REFERENCES users(id), id_g INT, FOREIGN KEY (id_g) REFERENCES groups(id));");
    echo "la table user_for_group est crée";
    echo "<br/>";

    //table des dettes
    mysqli_query($link, "CREATE TABLE dettes( id INT PRIMARY KEY AUTO_INCREMENT, id_source INT, FOREIGN KEY (id_source) REFERENCES users(id), montant INT UNSIGNED, id_cible INT, FOREIGN KEY (id_cible) REFERENCES users(id), msg_expl VARCHAR(250), date_creation DATE, statut VARCHAR(20), date_ferm DATE, msg_ferm VARCHAR(250));");
    echo "la table dettes est crée";
    echo "<br/>";

    //table des dépenses
    mysqli_query($link, "CREATE TABLE depenses( id INT PRIMARY KEY AUTO_INCREMENT, id_groupe INT, FOREIGN KEY (id_groupe) REFERENCES groups(id), id_creancier INT, FOREIGN KEY (id_creancier) REFERENCES users(id), type_repartition INT, montant INT UNSIGNED, date_creation DATE, titre VARCHAR(20));");
    echo "la table dépenses est crée";
    echo "<br/>";

    //table d'association débiteurs_dépense
    mysqli_query($link, "CREATE TABLE user_for_depense( id_u INT, FOREIGN KEY (id_u) REFERENCES users(id), id_d INT, FOREIGN KEY (id_d) REFERENCES depenses(id), credit INT);");
    echo "la table débiteurs est crée";
    echo "<br/>";

    mysqli_close($link);

?>
