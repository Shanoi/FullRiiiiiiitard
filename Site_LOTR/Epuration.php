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
    <link rel="stylesheet" href="TP2.css" media="screen">
    <title>Epuration</title>

    <META NAME="AUTHOR" CONTENT="LOUP Anthony - BOULET OLIVIER">
    <META NAME="DESCRIPTION" CONTENT="Les Mines de la Moria">

</head>

<html>

<?php

require_once('params.inc.php');
$pdo = connectPDO($dsn, $user, $password);

include_once("Message.php");
Message();

$stmt = $pdo->query("SELECT idObjet FROM objet WHERE Date_fin < curdate()"); // Selection des ID Objets
$stmt->setFetchMode(PDO::FETCH_BOTH);
$ID_Objet=$stmt->fetchAll(PDO::FETCH_COLUMN);

print_r($ID_Objet);

// Envoie mail :
foreach($ID_Objet as $id){
    echo "</br>$id</br>";

    // ID/Coordonnées du vendeur
    $stmt = $pdo->prepare("SELECT idObjet,Objet.Nom as NO,Utilisateur.Nom as NU,Prix_actuel,ID_U,Pseudo,Adresse,Numero,Email FROM Objet INNER JOIN Utilisateur WHERE ID_U=Pseudo AND idObjet=:id"); // ID/Coordonnées du vendeur
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);
    $Vendeur=$stmt->fetch();
    print_r($Vendeur);
    //

    //ID/Coordonnées de l'achteur
    $stmt = $pdo->prepare("SELECT DISTINCT ID_O,idObjet,Objet.Nom as NO,Utilisateur.Nom as NU,Prix_actuel,max(Enchere.Prix_propose) as PP,enchere.ID_U,Pseudo,Adresse,Numero,Email FROM Enchere INNER JOIN Utilisateur INNER JOIN Objet WHERE enchere.ID_U=Pseudo AND ID_O=idObjet AND idObjet=:id GROUP BY ID_O ORDER BY Prix_propose");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_BOTH);
    $Achteur=$stmt->fetch();
    print_r($Achteur);
    //
    if(!empty($Achteur)){
        $headers = 'From: lmdlmA@yopmail.com' . "\r\n" .
            'Reply-To: lmdlmA@yopmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Le message pour le vendeur
        $msg = "Felicitation, vous avez vendu votre Objet ".$Vendeur["NO"]." pour le prix de ".$Vendeur["Prix_actuel"]."\n"."Vous pouvez le contacter par : \n"."Mail : ".$Achteur["Email"]."\n Telephone : ".$Achteur["Numero"]."\n Adresse : ".$Achteur["Adresse"]."\n \n Votre meilleur site de vente au enchere : Les Mines de La Moria";
        $msg = wordwrap($msg,70,"\r\n"); // use wordwrap() if lines are longer than 70 characters
        mail($Vendeur["Email"],"Votre vente aux encheres est termine !",$msg,$headers);// send email

        print_r("Email envoye au vendeur a l'adresse : ".$Vendeur["Email"]."\n");

        // Le message pour l'acheteur
        $msg = "Felicitation, vous avez remporte une enchere de l\'objet".$Achteur["NO"]." pour le prix de ".$Achteur["Prix_actuel"]."\n"."Vous pouvez le contacter par : \n"."Mail : ".$Vendeur["Email"]."\n Telephone : ".$Vendeur["Numero"]."\n Adresse : ".$Vendeur["Adresse"]."\n \n Votre meilleur site de vente au enchere : Les Mines de La Moria";
        $msg = wordwrap($msg,70,"\r\n"); // use wordwrap() if lines are longer than 70 characters
        mail($Achteur["Email"],"Vous avez gagne un objet !",$msg,$headers);// send email
        print_r("Email envoye a l'achteur a l'adresse : ".$Achteur["Email"]."\n");
    }
    else{
        // Le message pour le vendeur
        $msg = "Dommage, vous avez pas vendu votre Objet ".$Vendeur["NO"]."\n \n Votre meilleur site de vente au enchere : Les Mines de La Moria";
        $msg = wordwrap($msg,70,"\r\n"); // use wordwrap() if lines are longer than 70 characters
        mail($Vendeur["Email"],"Votre vente aux encheres est termine !",$msg,$headers);// send email
    }


print_r("Envoie des mails termine \n");


// Epuration
    echo "L'ID : ";
    print_r($id);

    // Suppression des encheres associés.
    $stmt = $pdo->prepare("DELETE FROM enchere WHERE ID_O=:id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();

    // Suppression des objets
    $stmt = $pdo->prepare("DELETE FROM objet WHERE idObjet=:id");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    //

}

//print_r("Suppression enchere/Objet termine \n");

    $_SESSION["message"]="Epuration reussie !";
    $_SESSION["message_type"]="success";
    header("Location: /Site_LOTR/Home.php");


?>


</html>