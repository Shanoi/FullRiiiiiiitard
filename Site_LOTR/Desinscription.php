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
    <title>Desincription</title>

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

$stmt = $pdo->prepare("DELETE FROM utilisateur WHERE Pseudo='".$_SESSION["pseudo"]."'");
$stmt->execute();

$stmt = $pdo->prepare("DELETE FROM enchere WHERE ID_U='".$_SESSION["pseudo"]."'");
$stmt->execute();

$stmt = $pdo->prepare("DELETE FROM objet WHERE ID_U='".$_SESSION["pseudo"]."'");
$stmt->execute();



header("Location: /Site_LOTR/Deconnexion.php");

?>