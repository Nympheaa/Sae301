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
    <title>Votre Compte</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="css/styles.css" type="text/css" rel="stylesheet" />
    <link rel="icon" type="image/vnd.icon" href="images/favicon.png">
</head>

<body>

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
                        <a class="nav-link" href="account.php">Votre Compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    if (isset($_POST['email']) && isset($_POST['password'])) {

        $compte = new Compte($_POST['email'], $_POST['password'], "", "", "");
        $connected = $compte->seConnecter($bdd);
        if ($connected != 0) {
            $partenaire = new Partenaire("", "", "", "", "", "");
            $partenaire->initialiserPartenaire($bdd, $connected);
            $resultats = $partenaire->listerEvenement($bdd);







            ?>
            <!-- Profile Section -->
            <section class="container my-5">
                <h1 class="section-title">Votre profil</h1>
                <p class="text-center">Bienvenue à vous <?php echo $compte->nom . ' ' . $compte->prenom ?></p>
                <p class="text-center">Votre adresse :<?php echo $compte->identifiant ?> </p>

                <div class="row mt-5">

                    <!-- Messages envoyés -->
                    <div class="col-lg-6">
                        <h3 class="section-title">Vos demandes</h3>

                        <?php foreach ($resultats as $event):
                            if ($event->statut == 'En attente') {


                                ?>
                                <div class="message-box">
                                    <p>
                                        <?php echo $event->nom; ?>
                                    <p>
                                    <p>
                                        <?php echo $event->description; ?>
                                    <p>
                                    <p>
                                        <?php echo $event->date; ?>
                                    <p>
                                    <p>
                                        <?php echo $event->typeEvenement; ?>
                                    <p>
                                </div>


                                <?php
                            }
                        endforeach;

                        ?>
                        </select><br /><br />

                    </div>

                    <!-- Messages acceptés -->
                    <div class="col-lg-6">
                        <h3 class="section-title">Vos dernières acceptations</h3>
                        <?php foreach ($resultats as $event):
                            if ($event->statut == 'Accepter') {


                                ?>
                                <div class="message-box">
                                    <p>
                                        <?php echo $event->nom; ?>
                                    <p>
                                    <p>
                                        <?php echo $event->description; ?>
                                    <p>
                                    <p>
                                        <?php echo $event->date; ?>
                                    <p>
                                    <p>
                                        <?php echo $event->typeEvenement; ?>
                                    <p>
                                </div>


                                <?php
                            }
                        endforeach;

                        ?>
                    </div>
                </div>

                <!-- Contact Form -->
                    <h3 class="section-title">Contacter</h3>
                    <form action="enregistrerDemande.php" method="post" >
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom Evenement</label>
                            <input type="name" class="form-control" name="nom" placeholder="Nom de l'évènement">
                        </div>

                        <div class="mb-3">
                            <label for="event-type" class="form-label">Type d'évènement</label>

                            <select class="form-control" id="event-type" name="event-type">
                                <?php
                                $requete = "SELECT * FROM typeevenement";
                                $resultats = $bdd->query($requete);
                                foreach ($resultats->fetchAll(PDO::FETCH_ASSOC) as $row) {
                                    echo '<option>'.$row['Nom'].'</option>';
                                }

                                ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date évènement</label>
                            <input type="date" class="form-control" name="date" placeholder="Date de l'évènement">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control"  name="description" rows="4" placeholder="Description de l'évènement"></textarea>
                        </div>
                        <button type="submit" class="btn btn-red">Envoyer</button>
                    </form>
                </div>
            </section>
            <?php
        }
    } else {
        echo 'Connectez Vous';
    }

    ?>

    <footer>
        <div class="container text-center py-4">
            <div class="social-icons mb-3">
                <a href="https://www.facebook.com/LyoneSport/" class="mx-2">
                    <img src="images/facebook.png" alt="Facebook" class="social-icon">
                </a>
                <a href="https://www.instagram.com/lyonesport/" class="mx-2">
                    <img src="images/x.png" alt="X (Twitter)" class="social-icon">
                </a>
                <a href="https://www.instagram.com/lyonesport/" class="mx-2">
                    <img src="images/instagram.png" alt="Instagram" class="social-icon">
                </a>
                <a href="https://www.tiktok.com/@lyonesport" class="mx-2">
                    <img src="images/tiktok.png" alt="TikTok" class="social-icon">
                </a>
                <a href="https://www.youtube.com/user/lyonesports" class="mx-2">
                    <img src="images/youtube.png" alt="YouTube" class="social-icon">
                </a>
                <a href="https://m.twitch.tv/lyonesporttv" class="mx-2">
                    <img src="images/twitch.png" alt="Twitch" class="social-icon">
                </a>
            </div>


            <p>&copy; 2024 Lyon Esport. Tous droits réservés.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>