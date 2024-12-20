<?php

include 'Php/POO.php';

include("config/config.php");
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);
 
$compte= new Compte ($_POST["email"], $_POST["password"], "utilisateur",$_POST["nom"], $_POST["prenom"]);
$partenaire= new Partenaire ($_POST["entreprise"],$_POST["typeEntreprise"],$_POST["email"],$_POST["telephone"],$_POST["siren"],$compte);

echo print_r($compte,true);
echo print_r($partenaire,true); 
/* $partenaire->enregistrerCreation($bdd); */
$compte->enregistrerCreationCompte($bdd);

header('HTTP/1.1 307 Temporary Redirect');
header('Location: verificationconnexion.php');
exit();

?>