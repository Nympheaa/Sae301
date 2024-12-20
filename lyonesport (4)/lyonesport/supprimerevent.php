<?php
include("config/config.php");
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);

// suppression d'un perso grace a la requete delete //
$requete = 'DELETE FROM typeevenement  WHERE Id_TypeEvenement=' . $_POST["Id_TypeEvenement"];
$nbsuppression = $bdd->exec($requete);

// redirection
header('Location: admin.php');
exit();

?>