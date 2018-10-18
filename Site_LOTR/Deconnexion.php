<!doctype html>
<?php
session_start();

session_unset();

$_SESSION["message"]="Vous avez été déconnecté";
$_SESSION["message_type"]="success";

header("Location: /Site_LOTR/Home.php");

?>