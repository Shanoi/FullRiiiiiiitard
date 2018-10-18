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
                <li class="current_page_item"><a href="Vente.php">Vente</a></li>
                <li><a href="Achat.php">Achat</a></li>

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
                <table>
                    <td>
                        <div id="content" class="12u skel-cell-important">
                            <article>
                                <header>
                                    <h2 class="main-title">Nouvelle Vente :</h2>
                                </header>
                                <?php
                                if (!isset($_SESSION["pseudo"])) {
                                    echo "Vous devez etre connecte pour vendre un objet";
                                }

                                ?>
                                <!-- <a href="#" class="image-style1"><img src="images/pic01.jpg" alt=""></a> -->
                                <form action="http://localhost/Site_LOTR/AddObj.php" method="post"
                                      enctype="multipart/form-data" role="form">

                                    <fieldset>
                                        <legend> A vous le pognon ! (Les champs * sont obligatoires)</legend>
                                        <div id="Connexion">
                                            <table>
                                                <tr>
                                                    <div class="form-group">
                                                        <td><label>Nom de l'objet (*) : </label></td>
                                                        <td><input type="text" class="form-control" name="Nom" value="">
                                                        </td>
                                                    </div>
                                                </tr>

                                                <tr>
                                                    <div class="form-group">
                                                        <td><label>Prix de base : </label></td>
                                                        <td><input type="number" class="form-control" name="Prix"
                                                                   size="10" value=""></td>
                                                        <td>Euro</td>

                                                    </div>
                                                </tr>

                                                <tr>
                                                    <div class="form-group">
                                                        <td><label>Date debut : </label></br> (JJ/MM/AAAA)</td>
                                                        <td>
                                                            <div class="col-xs-3">
                                                                <input class="form-control" type="text" name="JDeb" maxlength="2">
                                                            </div>

                                                            <div class="col-xs-3">
                                                                <input class="form-control" type="text" name="MDeb" maxlength="2">
                                                            </div>

                                                            <div class="col-xs-4">
                                                                <input class="form-control" type="text" name="ADeb" maxlength="4">
                                                            </div>
                                                        </td>

                                                    </div>
                                                </tr>

                                                <tr>
                                                    <div class="form-group">
                                                        <td><label>Date fin (*) : </label></br> (JJ/MM/AAAA)</td>
                                                        <td>
                                                            <div class="col-xs-3">
                                                                <input class="form-control" type="text" name="JFin" maxlength="2">
                                                            </div>

                                                            <div class="col-xs-3">
                                                                <input class="form-control" type="text" name="MFin" maxlength="2">
                                                            </div>

                                                            <div class="col-xs-4">
                                                                <input class="form-control" type="text" name="AFin" maxlength="4">
                                                            </div>
                                                        </td>

                                                    </div>
                                                </tr>

                                                <tr>
                                                    <div class="form-group">
                                                        <td><label>Description (*) : </label></td>
                                                        <td><textarea class="form-control" rows="5" id="comment"
                                                                      name="Desc"></textarea></td>
                                                    </div>
                                                </tr>

                                                <tr>
                                                    <div class="form-group">
                                                        <td><label>Photo : </label></td>
                                                        <td><input type="file" accept="image/*" name="Photo"></td>
                                                    </div>
                                                </tr>

                                                <tr>
                                                    <td><input type="submit" class="btn btn-default"
                                                               value="A vous le pognon !"></td>
                                                </tr>

                                            </table>
                                        </div>

                                    </fieldset>
                                </form>

                            </article>
                        </div>
                    </td>
                    <td>
                        <div id="content" class="12u skel-cell-important">
                            <article>
                                <header>
                                    <h2 class="main-title">Mes Ventes :</h2>
                                </header>
                                <?php
                                if (!isset($_SESSION["pseudo"])) {
                                    echo "Connectez vous";
                                }
                                ?>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>Image</td>
                                        <td>Nom</td>
                                        <td>Prix de base (en euro)</td>
                                        <td>Prix actuel (en euro)</td>
                                        <td>Temps restant</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        $stmt = $pdo->query("SELECT * FROM Objet WHERE ID_U='" . $_SESSION["pseudo"] . "'");
                                        $stmt->setFetchMode(PDO::FETCH_BOTH);

                                        while ($row = $stmt->fetch()) {
                                            echo "<tr>";
                                            echo "<td> <img src='img_obj/".$row['Photo']."' alt='Pas d image' style='width:100px;height:100px;'></td>";
                                            echo "<td>".$row['Nom']."</td>";
                                            echo "<td>".$row['Prix_base']."</td>";
                                            echo "<td>".$row['Prix_actuel']."</td>";
                                            $Time = strtotime($row['Date_fin']);
                                            $remaining = $Time - time();
                                            $days_remaining = floor($remaining / 86400);
                                            $hours_remaining = floor(($remaining % 86400) / 3600);
                                            $minutes_remaining = floor(($remaining % 3600) / 60);
                                            echo "<td> $days_remaining jour(s), $hours_remaining heure(s), $minutes_remaining minute(s) </td>";

                                            ?>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <form action = "http://localhost/Site_LOTR/Objet.php" method = "get">
                                                            <input type="hidden" name="Obj_Id" value=<?php echo $row['idObjet'] ?>>
                                                            <input type="submit" class="btn btn-info btn-sm" value="Voir la page...">
                                                        </form>
                                                    </tr>
                                                    <!--
                                                    <tr>
                                                        <form action = "http://localhost/Site_LOTR/SupObjet.php" method = "get">
                                                            <input type="hidden" name="Obj_Id" value=<?php //echo $row['idObj'] ?>>
                                                            <input type="submit" class="btn btn-danger btn-sm" value="Supprimer l'objet...">
                                                        </form>
                                                    </tr>
                                                    -->
                                                </table>
                                            </td>

                                        <?php
                                            echo "</tr>";
                                        }
                                    ?>


                                    </tbody>
                                </table>

                            </article>
                        </div>
                    </td>
                </table>
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