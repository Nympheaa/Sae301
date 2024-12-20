<?php
include('config/config.php');
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);

include 'Php/POO.php';

$evenements= new evenement ($_POST["nom"], $_POST["description"], $_POST["date"],"", $_POST["event-type"]);
$evenements->enregistrerEvenement($bdd);

echo print_r($evenements,true);

header('HTTP/1.1 307 Temporary Redirect');
header('Location: account.php');
exit();



?>