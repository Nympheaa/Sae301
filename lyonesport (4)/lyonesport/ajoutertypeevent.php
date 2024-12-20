<?php

var_dump($_POST);
include("config/config.php");
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);

// mise à jour d'un perso avec une requête préparée //
$requete_preparee = $bdd->prepare('INSERT TO typeevenement (Id_typeEvenement, Nom, Id_compte ) VALUES (NULL,:Nom)');
$requete_preparee->bindValue(':Nom', $_POST["Nom"], PDO::PARAM_STR);
$requete_preparee->bindValue(':Id_compte', $_POST["Id_compte"], PDO::PARAM_INT);
$requete_preparee->bindValue(':Id_typeEvenement', $_POST["Id_typeEvenement"], PDO::PARAM_INT);
$res = $requete_preparee->execute();

header('Location: admin.php?action=modification&modif=OK');
exit();
?>