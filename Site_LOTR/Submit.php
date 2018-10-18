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
    <title>TP 3</title>

    <META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
    <META NAME="DESCRIPTION" CONTENT="Les Mines de la Moria">

</head>

<html>

<table>

    <?php

    if(empty($_POST["pseudo"]) || empty($_POST["pass"])){

        $_SESSION["message"]="Vous devez etre connecte";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Connexion.php");

        exit;
    }


    print_r(PDO::getAvailableDrivers());

    try
    {
// Data Source Name
        $dsn = 'mysql:host=127.0.0.1;
        port=3306;dbname=test';
        $pass='';
        $user='root';

// instanciation
        $pdo = new PDO($dsn, $user, $pass);

        echo "Connexion réussie </br>";

    }
    catch(PDOException$e)  {

        die("Erreur : " . $e->getMessage());

    }
	
	$results = $pdo->prepare("SELECT Pseudo FROM utilisateur WHERE Pseudo=:pseudo");
      $results->bindParam(':pseudo',$_POST["pseudo"]);
      $results->execute();
	   
	$res = $results->fetchAll();
	
    print_r($_POST["pass"]);
    print_r($_POST["confpass"]);
	if (count($res) == 0){
		if($_POST["pass"]==$_POST["confpass"]){
			echo "mdp pareil </br>";
			$stmt = $pdo->prepare("INSERT INTO utilisateur (Pseudo,Nom,Prenom,Adresse,Numero,Email,Mdp) VALUES (:pseudo,:nom,:prenom,:adresse,:num,:email, MD5(:pass))");
			$stmt->bindParam(':pseudo',$_POST["pseudo"]);
			$stmt->bindParam(':nom',$_POST["nom"]);
			$stmt->bindParam(':prenom',$_POST["prenom"]);
			$stmt->bindParam(':adresse',$_POST["adresse"]);
			$stmt->bindParam(':num',$_POST["num"]);
			$stmt->bindParam(':email',$_POST["email"]);
			$stmt->bindParam(':pass',$_POST["pass"]);
			$stmt->execute();

			//$stmt = $pdo->query("INSERT INTO utilisateur (Pseudo,Nom,Prenom,Adresse,Numero,Email,Mdp) VALUES ('Exemple','Ex',Ample','La','98765','email','sansmdp')");
		}

		else{
			echo "mdp ,pas pareil, pas d'inscription </br>";
		}
	}
    //print_r("INSERT INTO utilisateur (Pseudo,Nom,Prenom,Adresse,Numero,Email,Mdp) VALUES ('".$_POST["pseudo"]."' , '".$_POST["nom"]."' , '".$_POST["prenom"]."' , '".$_POST["adresse"]."' , '".$_POST["numero"]."' , '".$_POST["email"]."' , '".$_POST["pass"]."')");
    print_r($stmt);

	if (count($res) != 0){
        $_SESSION["message"]="Un utilisateur a deja ce pseudo";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Inscription.php");
    }
	
    else if (!$stmt){
        $_SESSION["message"]="L inscription a echoue";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Inscription.php");
    }

    else{
        $_SESSION["message"]="Inscription OK";
        $_SESSION["message_type"]="success";
        header("Location: /Site_LOTR/Connexion.php");
    }


    ?>


</table>

</html>


