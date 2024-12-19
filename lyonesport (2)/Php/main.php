<?php
include 'POO.php';


// Création des objets
$typeEvenement = new TypeEvenement("Compétition");
$compte = new Compte("admin01", "1234", "Admin", "Jean", "Dupont");

$evenement = new Evenement("Tournoi eSport", "Grand tournoi eSport", 20240301, "Prévu", "Gaming", $typeEvenement, $compte);
$partenaire = new Partenaire("RedBull", "Sponsor", "contact@redbull.com", 123456789, 1);

// Tests des méthodes
$compte->seConnecter();
$evenement->ajouterPartenaire($partenaire);
$evenement->afficherDetailsEvenement();
$evenement->listerParticipants();

$typeEvenement->afficherTypeEvenement();
$typeEvenement->modifierTypeEvenement("eSport");

$partenaire->creerEvenement($evenement);
$partenaire->participEevenement($evenement);
$compte->gererEvenement($evenement);

?>
