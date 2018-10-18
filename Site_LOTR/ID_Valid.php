<!doctype html>
<?php
session_start();
?>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="TP2.css" media="screen">
    <title>ID_Valid</title>

    <META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
    <META NAME="DESCRIPTION" CONTENT="Les Mines de la Moria">

</head>

<html>

<table>

    <?php

    require_once('params.inc.php');
    $pdo=connectPDO($dsn, $user, $password);
    if(empty($_POST["pseudo"]) || empty($_POST["pass"])){
        $_SESSION["message"]="Mauvais Mdp / Pseudo";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Connexion.php");
        exit;
    }


    //print_r(PDO::getAvailableDrivers());

       $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE `Pseudo`=:pseudo  AND `Mdp`=MD5(:pass) LIMIT 1");
       $stmt->bindParam(':pseudo',$_POST["pseudo"]);
       $stmt->bindParam(':pass',$_POST["pass"]);
       $stmt->execute();
       print_r($_POST["pseudo"]);
    echo "</br>";
       print_r($_POST["pass"]);
    echo "</br>";

       print_r($stmt);
       echo "<br/>";

       if (!$stmt){
           $_SESSION["message"]="Un problème est survenu sur notre base...";
           $_SESSION["message_type"]="warning";
           header("Location: /Site_LOTR/Connexion.php");
           exit;
       }


       else{

           if ($stmt->rowCount() == 1) {
               echo "Connexion réussie !";

               $_SESSION["pseudo"]=$_POST["pseudo"];
           }

           elseif ($stmt->rowCount() == 0) {
               $_SESSION["message"]="Mauvais Mdp / Pseudo";
               $_SESSION["message_type"]="warning";
               header("Location: /Site_LOTR/Connexion.php");
               exit;
           }

           else{
               $_SESSION["message"]="Je ne sais pas ce qu'il ce passe... C'est mauvais signe...";
               $_SESSION["message_type"]="warning";
               header("Location: /Site_LOTR/Connexion.php");
               exit;
           }
       }



       ?>

       <h2> Les donnees utilisateur :</h2>

       <table>

           <tr class="titre">
               <th>Pseudo</th>
               <th>Nom</th>
               <th>Prenom</th>
               <th>Adresse</th>
               <th>Numero</th>
               <th>Email</th>
           </tr>


           <?php


           /*
           $stmt->setFetchMode(PDO::FETCH_ASSOC);
           while($row = $stmt->fetch())
           {
               echo "<tr>";
               echo "<td>".$row['num']."</td>";
               echo "<td>".$row['designation']."</td>";
               echo "<td>".$row['prix']."</td>";
               echo "<td>".$row['stock']."</td>";
               echo "</tr>";
           }*/

        $stmt->setFetchMode(PDO::FETCH_BOTH);
        while($row = $stmt->fetch())
        {
            echo "<tr>";
            echo "<td>".$row['Pseudo']."</td>";
            echo "<td>".$row['Nom']."</td>";
            echo "<td>".$row['Prenom']."</td>";
            echo "<td>".$row['Adresse']."</td>";
            echo "<td>".$row['Numero']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "</tr>";
        }


        echo "</table>";
        mysqli_close($id);
           $_SESSION["message"]="Connexion réussie !";
           $_SESSION["message_type"]="success";
           header("Location: /Site_LOTR/Home.php");
        ?>



</table>

</html>


