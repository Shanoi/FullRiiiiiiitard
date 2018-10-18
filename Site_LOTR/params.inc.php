<!doctype html>
<!--[if lte IE 7]>
<html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]>
<html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]>
<html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!-->
<html class="no-js" lang="fr"> <!--<![endif]-->
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="TP2.css" media="screen">
    <title>TP 3</title>

    <META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
    <META NAME="DESCRIPTION" CONTENT="TP2">

</head>

<html>

<table>

    <?php // params . inc . php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "test";
    $dsn = 'mysql:host=127.0.0.1;
        port=3306;dbname=test';

    //show_table($host, $user, $password,$dbname);


    function show_table($host, $user, $password, $dbname)
    {

        $connexion = connect($host, $user, $password, $dbname);
        $result = mysqli_query($connexion, "SELECT * FROM test.utilisateur");

        if (!$result) {
            //echo 'Impossible d\'exécuter la requête : ' . mysqli_error();
            exit;
        }

        /*if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                print_r($row);
            }
        }*/

        /* echo "<br/> Exemple de fonction.<br/>";*/

        $row = mysqli_fetch_assoc($result);

        echo "<thead>";
        echo "<tr>";
        foreach ($row as $cle => $element) {
            echo "<td>" . $cle . "</td>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tr>";
        foreach ($row as $cle => $element) {
            echo "<td>" . $element . "</td>";
        }
        echo "</tr>";

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            foreach ($row as $cle => $element) {
                echo "<td>" . $element . "</td>";
            }
            echo "</tr>";

        }

        /* Libération des résultats */
        mysqli_free_result($result);

        mysqli_close($connexion);
    }


    function connect($host, $user, $password, $dbname)
    {
        $link = mysqli_connect($host, $user, $password, $dbname)
        or die("Erreur num : " . mysqli_connect_errno() . " Impossible de se connecter : " . mysqli_error());
        /*echo "Connexion reussie <br/>";*/

        return $link;

    }

    function connectPDO($dsn, $user, $password)
    {
        try {
            $link = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            //echo "Connexion à la base réussie </br>";
            // htmlentities($Obj_Time['Description'],ENT_QUOTES,'UTF-8')
			
			// $link->exec('SET NAMES utf8');

        } catch (PDOException$e) {

            die("Erreur : " . $e->getMessage());

        }

        return $link;

    }


    ?>


</table>

</html>
