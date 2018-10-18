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
    <title>Encherir</title>

    <META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
    <META NAME="DESCRIPTION" CONTENT="Les Mines de la Moria">

</head>

<?php

include_once("Message.php");
Message();


require_once('params.inc.php');
$pdo=connectPDO($dsn, $user, $password);
if(empty($_SESSION["pseudo"])){
    $_SESSION["message"]="Vous devez etre connecte";
    $_SESSION["message_type"]="warning";
    header("Location: /Site_LOTR/Connexion.php");

    exit;
}


$stmt = $pdo->prepare("SELECT Prix_actuel FROM objet WHERE idObjet=:IDO LIMIT 1");
$stmt->bindParam(':IDO',$_POST["Obj_Id"]);
$stmt->execute();
$Prix = $stmt->fetchColumn(0);

print_r($_POST["Obj_Id"]);
print_r($_SESSION["pseudo"]);
print_r($_POST["prix"]);
print_r($Prix);

if(!isset($_POST["prix"])){
    $_SESSION["message"]="Vous n avez pas mis de prix";
    $_SESSION["message_type"]="warning";
    header("Location: /Site_LOTR/Achat.php");
}

else if(intval($Prix)>intval($_POST["prix"])){
    $_SESSION["message"]="Votre prix n est pas assez eleve";
    $_SESSION["message_type"]="warning";
    header("Location: /Site_LOTR/Objet.php?Obj_Id=".$_POST["Obj_Id"]);
    exit;

}

else{

    $stmt = $pdo->prepare("INSERT INTO enchere (ID_U,ID_O,Prix_propose,Date) VALUES (:pseudo,:nom,:prix,now())");
    $stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
    $stmt->bindParam(':nom',$_POST["Obj_Id"]);
    $stmt->bindParam(':prix',$_POST["prix"]);
    $stmt->execute();

    $stmt = $pdo->prepare("UPDATE objet SET Prix_actuel=:prix WHERE idObjet=:IDO");
    $stmt->bindParam(':IDO',$_POST["Obj_Id"]);
    $stmt->bindParam(':prix',$_POST["prix"]);
    $stmt->execute();
}

$_SESSION["message"]="Enchere OK";
$_SESSION["message_type"]="success";
header("Location: /Site_LOTR/Objet.php?Obj_Id=".$_POST["Obj_Id"]);
exit;

?>