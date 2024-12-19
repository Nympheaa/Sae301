<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/styles.css" type="text/css" rel="stylesheet" />
  <link rel="icon" type="image/vnd.icon" href="images/favicon-16x16.png">
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="partenariats.html">
          <img src="images/lyonesport.png" alt="Lyon Esport">
      </a>
      <!-- Bouton burger pour petits écrans -->
      <button 
          class="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#navbarNav" 
          aria-controls="navbarNav" 
          aria-expanded="false" 
          aria-label="Toggle navigation"
      >
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
                  <a class="nav-link" href="partenariats.html">Partenariats</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="account.html">Votre Compte</a>
              </li>
          </ul>
      </div>
  </div>
</nav>

      <div class="container">
        <h2 class="section-title">Listes des demandes</h2>
      </div>
    </section>
    <section class="admin-section">
            <div class="demande">
                <p><strong>Nom :</strong> 
                <p><strong>Type :</strong> 
                <p><strong>Description :</strong> 
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="action" value="accept" class="accept-btn">Accepter</button>
                    <button type="submit" name="action" value="decline" class="decline-btn">Décliner</button>
                </form>
            </div>
    
    </section>

    <div class="container">
        <h2 class="section-title">Listes des demandes acceptées</h2>
      </div>
    </section>

    <!-- Liste des demandes acceptées -->
    <section class="accepted-section">
            <div class="accepted-item">
                <p><strong>Nom :</strong> <?= htmlspecialchars($row['nom']) ?></p>
                <p><strong>Type :</strong> <?= htmlspecialchars($row['type_evenement']) ?></p>
                <p><strong>Description :</strong> <?= htmlspecialchars($row['description']) ?></p>
            </div>
    </section>
</body>
</html>
