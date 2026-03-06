<?php
$flash = get_flash();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestionnaire de contacts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">Gestion Contacts</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter.php">Ajouter</a></li>
        <li class="nav-item"><a class="nav-link" href="rechercher.php">Rechercher</a></li>
        <li class="nav-item"><a class="nav-link" href="exporter.php">Export CSV</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<?php if ($flash): ?>
  <div class="alert alert-<?= htmlspecialchars($flash["type"]) ?>">
    <?= htmlspecialchars($flash["message"]) ?>
  </div>
<?php endif; ?>