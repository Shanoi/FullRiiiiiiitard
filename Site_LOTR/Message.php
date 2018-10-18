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
    <title>Message</title>

    <META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
    <META NAME="DESCRIPTION" CONTENT="Les Mines de la Moria">

</head>

<?php

function Message(){
    if(empty($_SESSION["message_type"])){
        $_SESSION["message_type"]="info";
    }
    if(!empty($_SESSION["message"])){
        echo "<div id='Cadre' class='Cadre_".$_SESSION["message_type"]."'>".$_SESSION["message"]."</div>";

    }

    $_SESSION["message"]="";
    $_SESSION["message_type"]="";

}

?>