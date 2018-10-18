<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8" /> 
  
    <link rel="stylesheet" href="TP1.css" media="all" />
    <title>TP 1</title>

<META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
<META NAME="DESCRIPTION" CONTENT="TP1">
</head>

<html>

<body>

<h1> TP 1 : </h1>

<?php
	echo "Ceci est une ligne <br/>";
	echo "Ceci est la 2eme ligne <br/>";
	echo "<a href=\"http://iut.univ-lyon1.fr/\"> Lien vers IUT lyon 1 </a><br/>";
	
	$nom="DOGE";
	$prenom="John";
	$age=37;
	
	echo $nom." <br/>";
	echo $prenom." <br/>";
	echo $age." <br/>";
	
	echo " $nom <br/> $prenom <br/> $age <br/>";
	echo $nom." <br/>".$prenom." <br/>".$age." <br/>";
	
?>

<h1> Calcul des variables </h1>

<?php
	
	$prix_table = 150;
	$remise_table = 0.70;
	$prix_armoire = 120;
	$remise_armoire = 0.90;
	
	
	echo "La valeur de la remise pour la table est:".$prix_table * (1-$remise_table)."<br/>";
	echo "La valeur du prix réduit pour la table est:".$prix_table * $remise_table."<br/>";
	
	echo "La valeur de la remise pour l'armoire est:".$prix_armoire * (1-$remise_armoire)."<br/>";
	echo "La valeur du prix réduit pour l'armoire est:".$prix_armoire * $remise_armoire."<br/>";
	
	echo "Table :".gettype($prix_table)." Remise table".gettype($remise_table)."<br/> armoire :".gettype($prix_armoire)." remise armoire :".gettype($remise_armoire)."<br/>";
	
	if ( $prix_armoire * $remise_armoire < $prix_table * $remise_table ){
		echo "La table est plus chère <br/>";
	}
	else{
		echo "L'armoire est plus chère <br/>";
	}

?>

<h1> Tableaux </h1>
	
<?php

	$MonTab = array(4,8,2,5);
	
	for($i=0;$i<4;$i++){
		echo $MonTab[$i]."<br/>";
	}
	
	$Somme=0;
	
	foreach($MonTab as $cle=>$element){
		$Somme=$Somme+$MonTab[$cle];
	}
	
	echo "La somme est $Somme <br/>";
	
	print_r($MonTab);

?>

<h1> Génération tableau HTML </h1>
	
	
<?php
	
	$Auteurs = array('Bob', 'Léa','Jack');
	$Livres = array('Livre1', 'Tome 1', 'Autre');

?>
	
	<h2> Tableau 1 </h2>
	
	<table>
	
	<tr>
		<th>Auteur</th>
		<th>Titre</th>
	</tr>
	
	
	<?php
		foreach($Auteurs as $cle => $element){
			echo "<tr>"."<td>".$Auteurs[$cle]."</td>"."<td>".$Livres[$cle]."</td>"."</tr>";
		}

	?>
	
	
	</table>
	
	<?php
	
	$Livres2 = array( "Livre1" => "Bob",
					 "Livre2" => "Bob",
					 "Tome1" => "Lea");
	?>
	
	
	<h2> Tableau 2 </h2>
	
	<table>
	
	<tr class="titre">
		<th>Auteur</th>
		<th>Titre</th>
	</tr>
	
	
	<?php
		$j=0;
		foreach($Livres2 as $cle => $element){
			if($j%2==0){
				echo "<tr class=\"pair\">"."<td>".$Livres2[$cle]."</td>"."<td>".$cle."</td>"."</tr>";
			}
			else{
				echo "<tr class=\"impair\">"."<td>".$Livres2[$cle]."</td>"."<td>".$cle."</td>"."</tr>";
			}
			$j++;
		}
		
	?>
	
	
	</table>
	
	
	
	
	
	</body>
	
</html>

