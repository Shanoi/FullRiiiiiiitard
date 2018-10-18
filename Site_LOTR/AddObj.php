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
    if(empty($_POST["Nom"]) || empty($_POST["Desc"])){
        $_SESSION["message"]="Le formulaire n est pas complet";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Vente.php");
        exit;
    }

    if(empty($_SESSION["pseudo"])){
        $_SESSION["message"]="Vous devez etre connecte";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Connexion.php");
        exit;
    }

    // Les dates :
    //Vérif des dates

    if(empty($_POST["MDeb"]) && empty($_POST["JDeb"]) && empty($_POST["ADeb"])){
        $_POST["MDeb"]="01";
        $_POST["JDeb"]="01";
        $_POST["ADeb"]="1970";
    }

    if(!checkdate($_POST["MDeb"],$_POST["JDeb"],$_POST["ADeb"]) || !checkdate($_POST["MFin"],$_POST["JFin"],$_POST["AFin"])){
        $_SESSION["message"]="Les dates sont pas bonnes";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Vente.php");
        exit;
    }

    //$Date_debut=date_create($_POST["ADeb"]."-".$_POST["MDeb"]."-".$_POST["JDeb"]);
    //$Date_fin=date_create($_POST["AFin"]."-".$_POST["MFin"]."-".$_POST["JFin"]);
    //$Date_debut= new DateTime($_POST["ADeb"]."-".$_POST["MDeb"]."-".$_POST["JDeb"]);
    //$Date_fin= new DateTime($_POST["AFin"]."-".$_POST["MFin"]."-".$_POST["JFin"]);

    $timezone = date_default_timezone_get();
    $date = date('Y-m-d', time());

    $Time_debut=strtotime($_POST["JDeb"]."-".$_POST["MDeb"]."-".$_POST["ADeb"]);
    $Time_fin=strtotime($_POST["JFin"]."-".$_POST["MFin"]."-".$_POST["AFin"]);

    //$Time_debut=date("M-d-Y", mktime(0, 0, 0, $_POST["MDeb"], $_POST["JDeb"], $_POST["ADeb"]));
    //$Time_fin=date("M-d-Y", mktime(0, 0, 0, $_POST["MFin"], $_POST["JFin"], $_POST["AFin"]));
    //echo "The current server timezone is: " . $timezone;
    echo "The current time is: " . strtotime($date);

    echo "LE TEMPS DEBUT :".$Time_debut;
    echo "LE TEMPS FIN :".$Time_fin;
    echo "LE TEMPS :".$Time_fin-$Time_debut;



    if($Time_debut > $Time_fin){
        $_SESSION["message"]="Les dates sont incoherentes";
        $_SESSION["message_type"]="warning";
        header("Location: /Site_LOTR/Vente.php");
        exit;
    }


    //print_r(PDO::getAvailableDrivers());
    //
    print_r($_FILES);
    //$stmt = $pdo->prepare("INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES (:pseudo, :Obj_Nom, curdate(), curdate() + INTERVAL 7 DAY, :Obj_Desc, :Obj_Prix, :Obj_Prix,'default.png');");
    $stmt = $pdo->prepare("INSERT INTO `test`.`objet` (`ID_U`, `Nom`, `Date_deb`, `Date_fin`, `Description`, `Prix_actuel`, `Prix_base`,`Photo`) VALUES (:pseudo, :Obj_Nom, :Date_debut, :Date_fin, :Obj_Desc, :Obj_Prix, :Obj_Prix,'defaut.png');");
    $stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
    $stmt->bindParam(':Obj_Nom',$_POST["Nom"]);

    if(strcmp($_POST["ADeb"], "1970" == 0)){
        $Today=date("Y-m-d");
        $stmt->bindParam(':Date_debut',$Today);
    }
    else{
        $Date_debut=$_POST["ADeb"]."-".$_POST["MDeb"]."-".$_POST["JDeb"];
        echo $Date_debut;
        $stmt->bindParam(':Date_debut',$Date_debut);
    }
    echo $Date_debut;
    $Date_fin=$_POST["AFin"]."-".$_POST["MFin"]."-".$_POST["JFin"];
    $stmt->bindParam(':Date_fin',$Date_fin);

    if(intval($_POST["Prix"]) <=0){
        $PrixNul=0;
        $stmt->bindParam(':Obj_Prix',$PrixNul);
    }
    else{
        $stmt->bindParam(':Obj_Prix',$_POST["Prix"]);
    }
    $stmt->bindParam(':Obj_Desc',$_POST["Desc"]);
    $stmt->execute();
    print_r($_FILES['Photo']['Name']);
    echo "</br>";

    print_r($stmt);
    echo "<br/>";

    $target_dir = "img_obj/";
    $target_file = $target_dir . basename($_FILES["Photo"]["name"]);

    if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["Photo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    $ID_Obj=$pdo->lastInsertId();
    print_r($ID_Obj);

    // TO DO / A FAIRE renommer le fichier pour éviter écrasemment
    /*
    rename("/img_obj/".$_FILES["Photo"]["name"], "/img_obj/".$ID_Obj.$_FILES["Photo"]["name"]);
    print_r(error_get_last());
    echo "</br>";
    print_r("/img_obj/".$_FILES["Photo"]["name"]);
    print_r("/img_obj/".$ID_Obj.$_FILES["Photo"]["name"]);
    echo "</br>";
    */
    print_r($_FILES['Photo']['name']);
    if(!isset($_FILES['Photo']['name'])){
        $stmt = $pdo->prepare("UPDATE objet SET Photo='".$_FILES['Photo']['name']."' WHERE idObjet=".$ID_Obj);
        $stmt->execute();
    }






    mysqli_close($id);


    $_SESSION["message"]="L enchere a ete cree avec succes";
    $_SESSION["message_type"]="success";
    header("Location: /Site_LOTR/Objet.php?Obj_Id=".$ID_Obj);

    ?>



</html>


