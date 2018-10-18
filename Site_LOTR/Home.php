<!DOCTYPE HTML>

<?php
session_start();

include_once("Message.php");
Message();

	function EmptyQuery(&$Query){
		//print_r($Query);
		//var_dump($Query);
		$Query=array(idObjet=>'-1', ID_U=>'Vide', Nom=>'Vide', Date_deb=>'00/00/0000', Date_fin=>'00/00/0000', Description=>'Aucun Produit', Prix_actuel=>'??', Prix_base=>'??');
	}

	require_once('params.inc.php');
	$pdo=connectPDO($dsn, $user, $password);

	$Obj_Query = $pdo->query("SELECT idObjet,Nom,Description,Date_fin,Prix_actuel,Photo FROM objet ORDER BY Date_fin ASC LIMIT 1");
	
	if (!$Obj_Query){
		//header("Location: https://www.google.fr/");
		EmptyQuery($Obj_Query);
	}

	$Obj_Query->setFetchMode(PDO::FETCH_BOTH);
	$Obj_Time =	$Obj_Query->fetch();

	$Obj_Query = $pdo->query("SELECT idObjet,Nom,Description,Date_fin,Prix_actuel,Photo FROM objet ORDER BY Date_deb DESC LIMIT 1");
	
	if (!$Obj_Query)
        echo "WTF?";

	$Obj_Query->setFetchMode(PDO::FETCH_BOTH);
	$Obj_New = $Obj_Query->fetch();
	
	$Obj_Best = $pdo->query("SELECT idObjet,Nom,Description,Date_fin,Prix_actuel,Photo FROM objet ORDER BY Prix_actuel DESC LIMIT 1");
	
	if (!$Obj_Best)
        echo "WTF?";

	$Obj_Best->setFetchMode(PDO::FETCH_BOTH);
	$Obj_Best = $Obj_Best->fetch();
	
	mysqli_close($id);
	
	$headers = 'From: lmdlmA@yopmail.com' . "\r\n" .
            'Reply-To: lmdlmA@yopmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
	
	$msg = "Felicitation, vous avez vendu votre Objet ";
	
	mail('olivboulet@laposte.net','Votre vente aux encheres est termine !',$msg);
	mail("olivboulet@laposte.net","test subject","test body");
	
	$to      = "olivboulet@laposte.net";
     $subject = "le sujet";
     $message = "Bonjour !";
     $headers = 'From: webmaster@example.com' . "\r\n" .
     'Reply-To: webmaster@example.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();

     
	
	if(mail($to, $subject, $message, $headers)){// send email
	
		echo "Mail";
		
	}
	else{
		
		echo "Pas Mail ùùùùààààààéé";
		
	}
	
?>


<html>
	<head>
		<title>Les Mines de la Moria</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css" />
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
	<body class="homepage">

		<!-- Header -->
		<div id="header-wrapper">
		
        	<div id="header" class="container">
            
            	<div id="logo"><h1><a href="Home.php"><img src="images/Logo.png" width="349" height="45" alt="" /></a></h1></div>
                <nav id="nav">
                    <ul>

                        <li class="current_page_item"><a href="Home.php">Accueil</a></li>
                        <li><a href="Vente.php">Vente</a></li>
                        <li><a href="Achat.php">Achat</a></li>
						
						<?php
						
						if (isset($_SESSION["pseudo"])) {
							echo "<li><a href='MonCompte.php'>Compte de ".$_SESSION["pseudo"]."</a></li>";
							echo "<li><a href='Deconnexion.php'> Deconnexion </a></li>";
						}
						else{
							echo "<li><a href=\"Connexion.php\">Connexion</a></li>";
							echo "<li><a href=\"Inscription.php\">Inscription</a></li>";
						}
						if (strcasecmp($_SESSION["pseudo"],"Admin")==0) {
							echo "<li><a href='Epuration.php'>Epuration</a></li>";
						}

						
						?>
						
                    </ul>
                </nav>
                
            </div>
			
			<div id="banner">
				<div class="container">
					<div class="row">
						<section class="12u">
							<header>
								<h2>Le Seigneur des Anneaux</h2>
								<span class="byline">Le Seigneur des anneaux est une trilogie cinématographique de fantasy réalisée par Peter Jackson et basée sur le roman éponyme en trois volumes de J. R. R. Tolkien. Les films composant cette trilogie sont La Communauté de l'anneau (2001), Les Deux Tours (2002) et Le Retour du roi (2003).</span>
							</header>
							<a href="https://fr.wikipedia.org/wiki/Le_Seigneur_des_anneaux_(s%C3%A9rie_de_films)" class="button button-alt">En savoir plus...</a>
						</section>
					</div>
				</div>
			</div>			

		</div>
		<!-- Header Ends Here -->

		<!-- Featured Area -->
			<div id="featured-wrapper">
			
				<div class="container">
					<div class="row double">
					
                        <section class="4u">
                           <header>
	                           <h2>Dépêchez-vous, temps bientôt écoulé </br></br> <?php echo $Obj_Time['Nom'] ?></h2>
                           </header>
                            <a href="Vente.php"><img src="img_obj/<?php echo $Obj_Time['Photo'] ?>" width="216" height="216" alt="" /></a>
                            <p>
								<?php
								echo "<td>".$Obj_Time['Description']."</td> </br>";
								echo "Prix : ".$Obj_Time['Prix_actuel']."€ </br>";
								$Time = strtotime($Obj_Time['Date_fin']);
								$remaining = $Time - time();
								$days_remaining = floor($remaining / 86400);
								$hours_remaining = floor(($remaining % 86400) / 3600);
								$minutes_remaining = floor(($remaining % 3600) / 60);
								echo "Temps restants : $days_remaining jour(s), $hours_remaining heure(s), $minutes_remaining minute(s)";
								?>

							</p>

							<form action = "http://localhost/Site_LOTR/Objet.php" method = "get">
								<input type="hidden" name="Obj_Id" value=<?php echo $Obj_Time['idObjet'] ?>>
								<input type="submit" class="button button-style1" value="J'achete...">
							</form>
                        </section>
                        <section class="4u">
                            <header>
	                            <h2>Nouveau ! </br></br> <?php echo $Obj_New['Nom'] ?></h2>
                            </header>
                            <a href="Vente.php"><img src="img_obj/<?php echo $Obj_New['Photo'] ?>" width="216" height="216" alt="" /></a>
                            <p>
								<?php
								echo "<td>".$Obj_New['Description']."</td> </br>";
								echo "Prix : ".$Obj_New['Prix_actuel']."€ </br>";
								$Time = strtotime($Obj_New['Date_fin']);
								$remaining = $Time - time();
								$days_remaining = floor($remaining / 86400);
								$hours_remaining = floor(($remaining % 86400) / 3600);
								$minutes_remaining = floor(($remaining % 3600) / 60);
								echo "Temps restants : $days_remaining jour(s), $hours_remaining heure(s), $minutes_remaining minute(s)";
								?>
							</p>
							<form action = "http://localhost/Site_LOTR/Objet.php" method = "get">
								<input type="hidden" name="Obj_Id" value=<?php echo $Obj_New['idObjet'] ?>>
								<input type="submit" class="button button-style1" value="J'achete...">
							</form>
                        </section>
                        <section class="4u">
                            <header>
	                            <h2>Meilleure vente de tous les temps </br></br> <?php echo $Obj_Best['Nom'] ?> </h2>
                            </header>
                            <a href="Vente.php"><img src="img_obj/<?php echo $Obj_Best['Photo'] ?>" width="216" height="216" alt="" /></a>
                            <p>
								<?php
								echo "<td>".$Obj_Best['Description']."</td> </br>";
								echo "Prix : ".$Obj_Best['Prix_actuel']."€ </br>";
								$Time = strtotime($Obj_Best['Date_fin']);
								$remaining = $Time - time();
								$days_remaining = floor($remaining / 86400);
								$hours_remaining = floor(($remaining % 86400) / 3600);
								$minutes_remaining = floor(($remaining % 3600) / 60);
								echo "Temps restants : $days_remaining jour(s), $hours_remaining heure(s), $minutes_remaining minute(s)";
								?>
							</p>
							<form action = "http://localhost/Site_LOTR/Objet.php" method = "get">
								<input type="hidden" name="Obj_Id" value=<?php echo $Obj_Best['idObjet'] ?>>
								<input type="submit" class="button button-style1" value="J'achete...">
							</form>
                        </section>
					
					</div>
				</div>
				
			</div>
		
		
		<!-- Featured Ends Here -->

		<!-- Copyright -->
            <div id="copyright" class="container">
                2015 - Olivier Boulet & Anthony Loup
            </div>


	</body>
</html>