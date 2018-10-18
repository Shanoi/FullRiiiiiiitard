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
						echo "<li class='current_page_item'><a href='MonCompte.php'>Compte de ".$_SESSION["pseudo"]."</a></li>";
						echo "<li><a href='Deconnexion.php'> Deconnexion </a></li>";
					}
					else{
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
	$pdo=connectPDO($dsn, $user, $password);
	if(empty($_SESSION["pseudo"])){
		$_SESSION["message"]="Vous devez etre connecte";
		$_SESSION["message_type"]="warning";
		header("Location: /Site_LOTR/Connexion.php");
		exit;
	}
	/*
	$stmt = $pdo->query("SELECT * FROM utilisateur WHERE Pseudo like '".$_POST["pseudo"]."'"." AND Mdp like '".$_POST["pass"]."'");
	
	mysqli_close($id);
	
	if (!$stmt)
        echo "WTF?";
	*/
	?>

	<div id="page">
		<div class="container">
			<div class="row">

				<div id="content" class="12u skel-cell-important">
					<article>
						<header>
							<h2 class="main-title">Modification des informations :</h2>
						</header>
						<!-- <a href="#" class="image-style1"><img src="images/pic01.jpg" alt=""></a> -->
						<form action = "http://localhost/Site_LOTR/NewInfo.php" method = "post" role="form"> <!-- A FAIRE / TO DO -->

							<fieldset>
								<legend> Les champs * sont obligatoires </legend>
								<div id="Connexion">
									<table>
										<tr>
											<div class="form-group">
												<td><label>Ancien mot de passe (*) : </label></td>
												<td><input type="password" class="form-control" name="oldpass" value=""></td>
											</div>
										</tr>
										<tr>
											<div class="form-group">
												<td><label>Nouveau mot de passe : </label></td>
												<td><input type="password" class="form-control" name="newpass" value=""></td>
											</div>
										</tr>

										<tr>
											<div class="form-group">
												<td><label>Confirmer nouveau mot de passe : </label></td>
												<td><input type="password" class="form-control" name="confnewpass" value=""></td>
											</div>
										</tr>

										<tr>
											<div class="form-group">
												<td><label>Nouvelle adresse : </label></td>
												<td><input type="text" class="form-control" name="adresse" value=""></td>
											</div>
										</tr>

										<tr>
											<div class="form-group">
												<td><label>Nouveau numero : </label></td>
												<td><input type="text" class="form-control" name="num" value=""></td>
											</div>
										</tr>

										<tr>
											<div class="form-group">
												<td><label>Nouvel e-mail : </label></td>
												<td><input type="text" class="form-control" name="email" value=""></td>
											</div>
										</tr>

										<tr>
											<td><input type="submit" class="btn btn-default" value="Valider les informations"></td>
										</tr>

									</table>
								</div>

							</fieldset>
						</form>

					</article>
				</div>
			</div>
		</div>
	</div>
		</body>
		
		<!-- Fin de page -->

		<!-- Copyright -->
            <div id="copyright" class="container">
                2015 - Olivier Boulet & Anthony Loup
            </div>


	</body>
</html>