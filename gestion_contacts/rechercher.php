<?php
require_once __DIR__ . "/includes/init.php";
require_once __DIR__ . "/includes/header.php";
?>

<h3>Rechercher un contact</h3>

<div class="bg-white p-3 rounded">
  <div class="mb-3">
    <label class="form-label">Recherche (nom, prénom, email, téléphone)</label>
    <input type="text" id="searchInput" class="form-control" placeholder="Tapez pour rechercher...">
  </div>

  <div id="results"></div>
</div>

<?php require_once __DIR__ . "/includes/footer.php"; ?>