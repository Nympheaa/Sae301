<?php
include('config/config.php');
$bdd = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);
include 'Php/POO.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
    <link rel="icon" type="image/vnd.icon" href="images/favicon.png">
</head>

<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="partenariats.php">
                <img src="images/lyonesport.png" alt="Lyon Esport">
            </a>
            <!-- Bouton burger pour petits écrans -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Liens de navigation -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Événements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="partenariats.php">Partenariats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="connexion.php">Se Connecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h2>Modification d'un event</h2>

    <form action="modifierevent.php" method="POST">
    

        <input type="submit" value="Modifier l'event" />
    </form>

</body>

</html>