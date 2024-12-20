<?php

var_dump($_POST);
include("config/config.php");
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);

// mise à jour d'un perso avec une requête préparée //
$requete_preparee = $bdd->prepare('UPDATE evenement SET nom=:nom, Description=:Description, Date=:Date, Statut=:Statut , Type=:Type Id_typeEvenement=:Id_typeEvenement Id_compte=:Id_compte WHERE Id_Evenement=:Id_Evenement');
$requete_preparee->bindValue(':Nom', $_POST["Nom"], PDO::PARAM_STR);
$requete_preparee->bindValue(':Description', $_POST["Description"], PDO::PARAM_STR);
$requete_preparee->bindValue(':Date', $_POST["Date"], PDO::PARAM_STR);
$requete_preparee->bindValue(':Statut', $_POST["Statut"], PDO::PARAM_STR);
$requete_preparee->bindValue(':Type', $_POST["Type"], PDO::PARAM_STR);
$requete_preparee->bindValue(':Id_typeEvenement', $_POST["Id_typeEvenement"], PDO::PARAM_INT);
$requete_preparee->bindValue(':Id_compte', $_POST["Id_compte"], PDO::PARAM_INT);
$requete_preparee->bindValue(':Id_Evenement', $_POST["Id_Evenement"], PDO::PARAM_INT);
$res = $requete_preparee->execute();


header('Location: admin.php?action=modification&modif=OK');
exit();
?>