<?php
    Include("../functions.php");
    $id_group = $_GET["id_group"];
    $users = get_group_users($id_group);
   
    foreach ($users as $user){

        
        
        //la liste des dépenses où user est le créancier
        $depenses = getUserDepenses_creances($user[0], $id_group);
        
        foreach ($depenses as $dep){
            //la liste des débiteurs de chaque dépense
            $debiteurs = getDebiteursFromDepense($dep[0]);
            $dette = 0;
            foreach ($debiteurs as $creancier){
                //la liste des dépenses où à la fois le débiteur est créancier et user est debiteur
                $debts = getSpecifiedDepense($creancier[0], $user[0], $id_group);
                /* var_dump($debts);
                echo "<br/>"; */
                $dette = $dette + getMemberCredit($creancier[0], $dep[0])["credit"];
                $credit = 0;
                foreach ($debts as $debt){
                    //on parcourt cette liste et on la compare avec le montant du crédit de ce débiteur :
                    //var_dump(getMemberCredit($user[0], $debt[0])["credit"]);
                    $montant = getMemberCredit($user[0], $debt[0]);
                    $credit = $credit + $montant["credit"];
                }
                echo getPseudo($user[0]);
                echo " / " .getPseudo($creancier[0]); 
                $somme = $dette - $credit;
                echo " " .$somme ." €";
                //var_dump($somme);
                echo "<br/>"; 
            }
               
        }
       
    }
    ?>