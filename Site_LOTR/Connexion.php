<!DOCTYPE HTML>
<!--
	MegaCorp by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<?php
session_start();
//session_destroy();
?>

<html>
	<head>
		<title>Les Mines de la Moria</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/bootstrap.min.css" media="all" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
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

			<div id="logo"><h1><a href="Home.php"><img src="images/Logo.png" width="349" height="45" alt="" /></a></h1></div>
			<nav id="nav">
				<ul>

					<li><a href="Home.php">Accueil</a></li>
					<li><a href="Vente.php">Vente</a></li>
					<li><a href="Achat.php">Achat</a></li>

					<?php

					if (isset($_SESSION["pseudo"])) {
						echo "<li><a href='MonCompte.php'>Compte de ".$_SESSION["pseudo"]."</a></li>";
						echo "<li><a href='Deconnexion.php'> Deconnexion </a></li>";
					}
					else{
						echo "<li class='current_page_item'><a href=\"Connexion.php\">Connexion</a></li>";
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
                    
                    	<div id="content" class="12u skel-cell-important">
                        	<article>
                            	<header>
                                    <h2 class="main-title">Connexion :</h2>
                                </header>
                                <!-- <a href="#" class="image-style1"><img src="images/pic01.jpg" alt=""></a> -->
									<form method = "post" action = "ID_Valid.php" role="form">
								
										<fieldset>
											<legend> Entrez dans la terre du milieu... </legend>
											<div id="Connexion">
											<table>
											<tr>
												<div class="form-group">
											<td><label>Nom d'utilisateur : </label></td>
											<td><input type="text" class="form-control" name="pseudo" value=""></td>
													</div>
											</tr>
											
											<tr>
												<div class="form-group">
											<td><label>Password : </label></td>
											<td><input type="password" class="form-control" name="pass" value=""></td>
													</div>
											</tr>
											
											<tr>
												<td><input type="submit" class="btn btn-default" value="Entrez dans la Terre du Milieu..."></td>
											</tr>
												
											</table>
											</div>
											
											<p>Toujours pas inscrit ? <a href="Inscription.php">Rejoignez nous !</a></p>
												
												
												
									</fieldset>
								</form>
							
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            
		<!-- /Page -->

		<!-- Copyright -->
            <div id="copyright" class="container">
                2015 - Olivier Boulet & Anthony Loup
            </div>


	</body>
</html>