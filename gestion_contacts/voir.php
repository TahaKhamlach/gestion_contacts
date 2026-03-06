<?php
require_once __DIR__ . "/includes/init.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) {
    set_flash("danger", "ID invalide.");
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    set_flash("danger", "Contact introuvable.");
    header("Location: index.php");
    exit;
}

require_once __DIR__ . "/includes/header.php";
?>

<h3>Détails du contact</h3>

<div class="bg-white p-3 rounded">
  <div class="row g-3">
    <div class="col-md-6"><strong>Nom :</strong> <?= htmlspecialchars($contact["nom"]) ?></div>
    <div class="col-md-6"><strong>Prénom :</strong> <?= htmlspecialchars($contact["prenom"]) ?></div>

    <div class="col-md-6"><strong>Email :</strong> <?= htmlspecialchars($contact["email"] ?? "") ?></div>
    <div class="col-md-6"><strong>Téléphone :</strong> <?= htmlspecialchars($contact["telephone"] ?? "") ?></div>

    <div class="col-12"><strong>Adresse :</strong><br><?= nl2br(htmlspecialchars($contact["adresse"] ?? "")) ?></div>

    <div class="col-md-6"><strong>Date de naissance :</strong> <?= htmlspecialchars($contact["date_naissance"] ?? "") ?></div>
    <div class="col-md-6"><strong>Date d'ajout :</strong> <?= htmlspecialchars($contact["date_creation"]) ?></div>

    <div class="col-md-6"><strong>Dernière modification :</strong> <?= htmlspecialchars($contact["date_modification"]) ?></div>

    <div class="col-12"><strong>Notes :</strong><br><?= nl2br(htmlspecialchars($contact["notes"] ?? "")) ?></div>

    <div class="col-12 d-flex gap-2 mt-2">
      <a class="btn btn-warning" href="modifier.php?id=<?= (int)$contact["id"] ?>">Modifier</a>
      <a class="btn btn-secondary" href="index.php">Retour</a>
    </div>
  </div>
</div>

<?php require_once __DIR__ . "/includes/footer.php"; ?>