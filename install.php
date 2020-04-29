<?php
include("functions.php");


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$con = mysqli_connect($dbhost, $dbuser, $dbpass);

if(! $con ){
    echo 'Connected failure<br>';
}
echo 'Connected successfully<br>';
$sql = "CREATE DATABASE HAKA";

if (mysqli_query($con, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($con);
}

include("creation_table.php");

mysqli_select_db($con, "HAKA");


addUser("tester@gmail.com","mdp","Louis","Dupont",25,"louisdupont");
addUser("lea@gmail.com","lea123","Lea","Martin",31,"leamartin");

$res = mysqli_prepare($con, "INSERT INTO friends (id_1, id_2, etat) VALUES (?, ?, ?);");
$id_1 = getIdFromPseudo("louisdupont");
$id_2 = getIdFromPseudo("leamartin");
$etat = 2;
mysqli_stmt_bind_param($res, 'ddi', $id_1, $id_2, $etat);
mysqli_stmt_execute($res);

addDette($id_1,$id_2,29,"Restaurant","2019-05-10","1","0000-00-00","");
addDette($id_2,$id_1,42,"Voyage","2019-05-28","1","0000-00-00","");
addDette($id_2,$id_1,168,"Avion","2019-04-05","2","2019-05-01","Remboursement effectué par virement");

$group_id = addGroup("Best Friends","Groupe pour gérer les dépenses lors des prochaines vacances",getIdFromPseudo("louisdupont"));
addUserToGroup(getIdFromPseudo("louisdupont"),getGroupId("Best Friends"));
addUserToGroup(getIdFromPseudo("leamartin"),getGroupId("Best Friends"));
userFound("Thomas");
addUserToGroup(findUser("Thomas"), getGroupId("Best Friends"));

$id_depense = addDepense($group_id, getIdFromPseudo("louisdupont"), 60, "2019-03-10", "Essence");
$users = get_group_users($group_id);
foreach ($users as $id_user){
    addDebiteur($id_user[0], $id_depense, floor(60/3));
}

$id_depense = addDepense($group_id, getIdFromPseudo("leamartin"), 24, "2019-03-20", "Courses");
$users = get_group_users($group_id);
$i = 1;
foreach ($users as $id_user){
    addDebiteur($id_user[0], $id_depense, floor(10));
    if($i == 1) {
        editCredit(4,$id_depense,$id_user[0]);
    } else if ($i == 2) {
        editCredit(8,$id_depense,$id_user[0]);
    } else {
        editCredit(12,$id_depense,$id_user[0]);
    }
    $i++;
}

$id_depense = addDepense($group_id, getIdFromPseudo("Thomas"), 99, "2019-03-25", "Location voiture");
$users = get_group_users($group_id);
foreach ($users as $id_user){
    addDebiteur($id_user[0], $id_depense, floor(99/3));
}

mysqli_close($con);

header("Location: ./");


?>
