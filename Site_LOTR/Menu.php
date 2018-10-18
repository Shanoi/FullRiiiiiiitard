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

function Menu($menu){
?>
<!-- Header -->
		<div id="header-wrapper">

        	<div id="header" class="container">

            	<div id="logo"><h1><a href="Home.php"><img src="images/Logo.png" width="349" height="45" alt="" /></a></h1></div>
                <nav id="nav">
                    <ul>

                        <li <?php if(strcmp($menu,"Home")==0) echo "class='current_page_item'"; ?>><a href="Home.php">Accueil</a></li>
                        <li <?php if(strcmp($menu,"Vente")==0) echo "class='current_page_item'"; ?>><a href="Vente.php">Vente</a></li>
                        <li <?php if(strcmp($menu,"Achat")==0) echo "class='current_page_item'"; ?>><a href="Achat.php">Achat</a></li>

						<?php

						if (isset($_SESSION["pseudo"])) {
                            echo "<li";
                            if(strcmp($menu,"MoCompte")==0) echo "class='current_page_item'";
                            echo "><a href='MonCompte.php'>Compte de ".$_SESSION["pseudo"]."</a></li>";
                            echo "<li";
                            if(strcmp($menu,"Deconnexion")==0) echo "class='current_page_item'";
                            echo "><a href='Deconnexion.php'> Deconnexion </a></li>";
                        }
                        else{
                            echo "<li";
                            if(strcmp($menu,"Connexion")==0) echo "class='current_page_item'";
                            echo "><a href=\"Connexion.php\">Connexion</a></li>";
                            echo "<li";
                            if(strcmp($menu,"Inscription")==0) echo "class='current_page_item'";
                            echo "><a href=\"Inscription.php\">Inscription</a></li>";
                        }
						if (strcasecmp($_SESSION["pseudo"],"Admin")==0) {
                            echo "<li";
                            if(strcmp($menu,"Epuration")==0) echo "class='current_page_item'";
                            echo "><a href='Epuration.php'>Epuration</a></li>";
                        }


						?>

</ul>
</nav>

</div>
        </div>

<?php
}

?>