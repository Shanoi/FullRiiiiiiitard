<!DOCTYPE HTML>

<?php session_start(); ?>

<!--
	MegaCorp by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
<head>
    <title>Les Mines de la Moria</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="all"/>
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-panels.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/style-desktop.css"/>
    </noscript>
</head>
<?php
include_once("Message.php");
Message();
?>
<body>

<!-- Header -->
<div id="header-wrapper">

    <div id="header" class="container">

        <div id="logo"><h1><a href="Home.php"><img src="images/Logo.png" width="349" height="45" alt=""/></a></h1></div>
        <nav id="nav">
            <ul>

                <li><a href="Home.php">Accueil</a></li>
                <li><a href="Vente.php">Vente</a></li>
                <li><a href="Achat.php">Achat</a></li>

                <?php

                if (isset($_SESSION["pseudo"])) {
                    echo "<li class='current_page_item'><a href='MonCompte.php'>Compte de " . $_SESSION["pseudo"] . "</a></li>";
                    echo "<li><a href='Deconnexion.php'> Deconnexion </a></li>";
                } else {
                    echo "<li><a href=\"Connexion.php\">Connexion</a></li>";
                    echo "<li><a href=\"Inscription.php\">Inscription</a></li>";
                }

                ?>

            </ul>
        </nav>

    </div>

</div>
<!-- Header Ends Here -->

<!-- Page -->

<body>

<?php

require_once('params.inc.php');
$pdo = connectPDO($dsn, $user, $password);
if (empty($_SESSION["pseudo"])) {
    $_SESSION["message"] = "Vous devez etre connecte";
    $_SESSION["message_type"] = "warning";
    header("Location: /Site_LOTR/Connexion.php");

    exit;
}

$stmt = $pdo->query("SELECT * FROM utilisateur WHERE Pseudo='" . $_SESSION["pseudo"] . "'");

mysqli_close($id);

if (!$stmt)
    echo "WTF?";

$stmt->setFetchMode(PDO::FETCH_BOTH);
$row = $stmt->fetch();

?>
<div id="banner">

    <center>



    <div id="Connexion">

        <table>

            <tr>
                <td><label>Nom d'utilisateur : </label></td>
                <?php echo "<td>" . $row['Pseudo'] . "</td>"; ?>
            </tr>

            <tr>
                <td><label>Nom : </label></td>
                <?php echo "<td>" . $row['Nom'] . "</td>"; ?>
            </tr>

            <tr>
                <td><label>Prenom : </label></td>
                <?php echo "<td>" . $row['Prenom'] . "</td>"; ?>
            </tr>

            <tr>
                <td><label>Adresse : </label></td>
                <?php echo "<td>" . $row['Adresse'] . "</td>"; ?>
            </tr>

            <tr>
                <td><label>Numero : </label></td>
                <?php echo "<td>" . $row['Numero'] . "</td>"; ?>
            </tr>

            <tr>
                <td><label>E-mail : </label></td>
                <?php echo "<td>" . $row['Email'] . "</td>"; ?>
            </tr>

        </table>

    </div>

    <input type="button" class="btn btn-info" name="lien1" value="Modifier mes Informations personnelles"
           onclick="self.location.href='ModificationInfo.php'" onclick>
    <input type="button" class="btn btn-danger" name="lien1" value="Supprimer mon compte"
           onclick="self.location.href='Desinscription.php'" onclick>
    </center>
</div>
</br>
</body>

<!-- Fin de page -->

<!-- Copyright -->
<div id="copyright" class="container">
    2015 - Olivier Boulet & Anthony Loup
</div>


</body>
</html>