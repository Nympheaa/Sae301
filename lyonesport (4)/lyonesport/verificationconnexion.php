<?php
include('config/config.php');
include 'Php/POO.php';
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);

if (isset($_POST['email']) && isset($_POST['password'])) {
    $compte = new Compte($_POST['email'], $_POST['password'], "", "", "");
    $connected = $compte->seConnecter($bdd);
    if ($connected != 0) {
        if ($compte->role == 'admin') {
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: admin.php');
            exit();
        } else {
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: account.php');
            exit();

        }
    } else {
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: erreurconnexion.php');
        exit();

    }

}





?>