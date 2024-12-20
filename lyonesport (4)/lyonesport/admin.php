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

  <!-- Main Content -->
  <div class="container">
    <h2 class="text-center mt-4">Formulaire demande de partenaria</h2>
    <hr class="border border-danger border-2 opacity-50">



    <?php
    if (isset($_POST['email']) && isset($_POST['password'])) {

      $compte = new Compte($_POST['email'], $_POST['password'], "", "", "");
      $connected = $compte->seConnecter($bdd);
      if ($connected != 0) {

        $evenements = [];
        $requete = "SELECT evenement.Nom, evenement.Description, evenement.Date, evenement.Statut, typeevenement.Nom as eventNom
        FROM evenement 
        INNER JOIN  typeevenement ON evenement.Id_typeEvenement = typeevenement.Id_typeEvenement";

        $resultats = $bdd->query($requete);
        foreach ($resultats->fetchAll(PDO::FETCH_ASSOC) as $row) {
          $event = new evenement($row['Nom'], $row['Description'], $row['Date'], $row['Statut'], $row['eventNom']);
          array_push($evenements, $event);
        }




        ?>
        <!-- Requests Section -->
        <div class="form-container">
          <h3>Demandes reçues</h3>
          <?php foreach ($evenements as $event):
            if ($event->statut == 'En attente') {

              ?>
              <div class="request-item d-flex justify-content-between align-items-center">
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
                <div>
                  <button class="btn btn-accept">Accepter</button>
                  <button class="btn btn-decline">Décliner</button>
                </div>
                
              </div>
              <hr class="border border-secondary">


              <?php
            }
          endforeach;

          ?>
          

        <!-- Collaborations Section -->
        <div class="form-container">
          <h3>Liste des collaborations</h3>
          <ul id="collaboration-list" class="list-group">

            <?php foreach ($evenements as $event):
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


            <!-- Dynamic content will be inserted here -->
          </ul>
        </div>

      

        <!-- Settings Section -->
        <div class="form-container settings-container">
          <h3>Réglages</h3>
          <a href="pageajoutevent.php"><button class="btn btn-success" >Ajouter un événement</button></a>
          <a href="pagesupevent.php"><button class="btn btn-danger">Supprimer un événement</button></a>
          <a href="pagemodifevent.php"><button class="btn btn-success">Modifier un événement</button></a>
          


        </div>
      </div>

      <?php
      }
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



</body>

</html>