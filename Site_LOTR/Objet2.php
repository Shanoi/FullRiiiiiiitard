<!DOCTYPE HTML>
    <?php
    session_start();
	
	function EmptyQuery(&$Query){
		//print_r($Query);
		//var_dump($Query);
		$Query=array(idObjet=>'-1', ID_U=>'Vide', Nom=>'Vide', Date_deb=>'00/00/0000', Date_fin=>'00/00/0000', Description=>'Aucun Produit', Prix_actuel=>'??', Prix_base=>'??');
	}

	require_once('params.inc.php');
	$pdo=connectPDO($dsn, $user, $password);

	$Obj_Query = $pdo->query("SELECT objet.Nom NO, ID_U, Date_deb, Date_fin, Description, Prix_actuel, Prix_base, Photo, Adresse, Utilisateur.Nom Nom, Numero, Email FROM objet INNER JOIN Utilisateur WHERE ID_U = Pseudo AND idObjet ='".$_GET["Obj_Id"]."'");
	
	if (!$Obj_Query){
		EmptyQuery($Obj_Query);
	}

	$Obj_Query->setFetchMode(PDO::FETCH_BOTH);
	$Obj_pres =	$Obj_Query->fetch();
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
							echo "<li><a href=\"Inscripion.php\">Inscripion</a></li>";
						}
						
						?>
						
                    </ul>
                </nav>
                
            </div>

		</div>
		<!-- Header Ends Here -->

		<!-- Page -->
		
			<div id="featured-wrapper">
			
				<div class="container">
				
					<div class="row">
					
						<div class="row">
						
							<section class="6u">
							
							<h2>Voici votre Objet: </br></br> <?php echo $Obj_pres['NO'] ?></h2>
					   
							<a href="Vente.php"><img src="img_obj/<?php echo $Obj_pres['Photo'] ?>" width="216" height="216" alt="" /></a>
							
							</section>
							
							<section class="6u">
								
									<?php
									echo $Obj_pres['Description']."</br>";
									echo "Prix : ".$Obj_pres['Prix_actuel']."€ </br>";
									echo "Prix d'origine : ".$Obj_pres['Prix_base']."€</br>";
									$Time = strtotime($Obj_pres['Date_fin']);
									$remaining = $Time - time();
									$days_remaining = floor($remaining / 86400);
									$hours_remaining = floor(($remaining % 86400) / 3600);
									$minutes_remaining = floor(($remaining % 3600) / 60);
									echo "Temps restants : $days_remaining jour(s), $hours_remaining heure(s), $minutes_remaining minute(s)</br>";
									echo "Vendeur : ".$Obj_pres['ID_U']."</br>";
									echo "Nom du vendeur : ".$Obj_pres['Nom']."</br>";
									echo "Localisation : ".$Obj_pres['Adresse']."</br>";
									echo "Téléphone : ".$Obj_pres['Numero']."</br>";
									echo "Mail : ".$Obj_pres['Email']."</br>";
									?>

									<form action = "http://localhost/Site_LOTR/Objet.php" method = "get">
									<input type="hidden" name="Obj_Id" value=<?php echo $Obj_pres['idObjet'] ?>>
									<input type="submit" class="button button-style1" value="J'achete...">
									</form>
						
							</section>
					
						</div>
                      
					</div>
				</div>
				
			</div>
		
		
		<!-- Page -->

		<!-- Copyright -->
            <div id="copyright" class="container">
                2015 - Olivier Boulet & Anthony Loup
            </div>


	</body>
</html>