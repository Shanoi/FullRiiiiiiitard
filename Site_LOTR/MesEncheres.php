<!DOCTYPE HTML>
<?php
session_start();
?>
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
require_once('params.inc.php');
$pdo = connectPDO($dsn, $user, $password);

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
                <li class="current_page_item"><a href="Achat.php">Achat</a></li>

                <?php

                if (isset($_SESSION["pseudo"])) {
                    echo "<li><a href='MonCompte.php'>Compte de " . $_SESSION["pseudo"] . "</a></li>";
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

<div id="page">
    <div class="container">
        <div class="row">
            <div id="Achat">
                <?php
                if (!isset($_SESSION["pseudo"])) {
                    echo "Vous devez etre connecte pour voir les encheres";
                }

                ?>

                <div id="content" class="12u skel-cell-important">
                    <article>

                        <table>
                            <td>
                                <a class="btn btn-info btn-lg" type="button" href="Achat.php">Les offres</a>
                            </td>
                            <td>
                                <a class="btn btn-info btn-lg active" type="button" href="MesEncheres.php">Mes encheres</a>
                            </td>
                        </table>

                        <header>
                            <h2 class="main-title">Mes Encheres :</h2>
                        </header>
                        <?php
                        if (!isset($_SESSION["pseudo"])) {
                            $_SESSION["message"]="Vous devez etre connecte";
                            $_SESSION["message_type"]="warning";
                            header("Location: /Site_LOTR/Connexion.php");

                        }
                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <td>Image</td>
                                <td>Nom</td>
                                <td>Prix de base </br> (en euro)</td>
                                <td>Prix actuel </br>(en euro)</td>
                                <td>Prix propose</td>
                                <td>Temps restant</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $stmt = $pdo->query("SELECT DISTINCT Enchere.ID_O,Enchere.ID_U,max(Enchere.Prix_propose) as Prix_propose,Enchere.Date,idObjet,Nom,Prix_actuel,Prix_base,Photo,Date_fin FROM Enchere INNER JOIN Objet ON Objet.idObjet=ID_O WHERE  Enchere.ID_U='" . $_SESSION["pseudo"] . "' GROUP BY ID_O ORDER BY Prix_propose");
                            $stmt->setFetchMode(PDO::FETCH_BOTH);

                            while ($row = $stmt->fetch()) {
                                echo "<tr>";
                                echo "<td> <img src='img_obj/" . $row['Photo'] . "' alt='Pas d image' style='width:100px;height:100px;'></td>";
                                echo "<td>" . $row['Nom'] . "</td>";
                                echo "<td>" . $row['Prix_base'] . "</td>";
                                echo "<td>" . $row['Prix_actuel'] . "</td>";
                                echo "<td>" . $row['Prix_propose'] . "</td>";
                                $Time = strtotime($row['Date_fin']);
                                $remaining = $Time - time();
                                $days_remaining = floor($remaining / 86400);
                                $hours_remaining = floor(($remaining % 86400) / 3600);
                                $minutes_remaining = floor(($remaining % 3600) / 60);
                                echo "<td> $days_remaining jour(s), $hours_remaining heure(s), $minutes_remaining minute(s) </td>";

                                if($row['Prix_propose']<$row['Prix_actuel']){
                                    echo "<td> <form action='http://localhost/Site_LOTR/Objet.php' method='get'>
                                                <input type='hidden' name='Obj_Id' value=".$row['idObjet'].">
                                                <input type='submit' class='btn btn-danger btn-sm'
                                                       value='Vous n etes plus acheteur RENCHERISSEZ...'>
                                            </form>
                                             </td>";
                                }
                                else if($row['Prix_propose']>=$row['Prix_actuel']){
                                    echo "<td> <form action='http://localhost/Site_LOTR/Objet.php' method='get'>
                                                <input type='hidden' name='Obj_Id' value=".$row['idObjet'].">
                                                <input type='submit' class='btn btn-info btn-sm'
                                                       value='Voir la page...'>
                                            </form>
                                             </td>";

                                }

                                echo "</tr>";
                            }
                            ?>


                            </tbody>
                        </table>

                    </article>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- /Page -->

<!-- Copyright -->
<div id="copyright" class="container">
    Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a
        href="http://unsplash.com/cc0">CC0</a>)
</div>


</body>
</html>