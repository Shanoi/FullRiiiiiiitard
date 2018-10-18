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

<?php

require_once('params.inc.php');
$pdo=connectPDO($dsn, $user, $password);
if(empty($_SESSION["pseudo"])){
    $_SESSION["message"]="Vous devez etre connecte";
    $_SESSION["message_type"]="warning";
    header("Location: /Site_LOTR/Connexion.php");

    exit;
}


//print_r(PDO::getAvailableDrivers());

$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE Pseudo=:pseudo  AND Mdp=:pass LIMIT 1");
$stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
$stmt->bindParam(':pass',$_POST["oldpass"]);
$stmt->execute();
if($stmt->rowCount()!=1){
    $_SESSION["message"]="Mauvais mdp";
    $_SESSION["message_type"]="warning";
    header("Location: /Site_LOTR/MonCompte.php");

    exit;
}

if(!empty($_POST["newpass"])){ // Il a changer le mdp
    if(strcmp($_POST["newpass"],$_POST["confnewpass"])==0){ // les mdp sont pareils
        $stmt = $pdo->prepare("UPDATE utilisateur SET Mdp=:pass WHERE Pseudo=:pseudo");
        $stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
        $stmt->bindParam(':pass',$_POST["newpass"]);
        $stmt->execute();
    }
}

if(!empty($_POST["adresse"])){
    $stmt = $pdo->prepare("UPDATE utilisateur SET Adresse=:addresse WHERE Pseudo=:pseudo");
    $stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
    $stmt->bindParam(':addresse',$_POST["adresse"]);
    $stmt->execute();
}

if(!empty($_POST["num"])){
    $stmt = $pdo->prepare("UPDATE utilisateur SET Numero=:num WHERE Pseudo=:pseudo");
    $stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
    $stmt->bindParam(':num',$_POST["num"]);
    $stmt->execute();
}

if(!empty($_POST["email"])){
    $stmt = $pdo->prepare("UPDATE utilisateur SET Email=:mail WHERE Pseudo=:pseudo");
    $stmt->bindParam(':pseudo',$_SESSION["pseudo"]);
    $stmt->bindParam(':mail',$_POST["email"]);
    $stmt->execute();
}
$_SESSION["message"]="Modification(s) reussie(s) avec success";
$_SESSION["message_type"]="success";
header("Location: /Site_LOTR/MonCompte.php");

?>