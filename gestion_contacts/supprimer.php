<?php
require_once __DIR__ . "/includes/init.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    set_flash("danger", "Méthode non autorisée.");
    header("Location: index.php");
    exit;
}

$id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
if ($id <= 0) {
    set_flash("danger", "ID invalide.");
    header("Location: index.php");
    exit;
}

// Vérifier existence
$stmt = $pdo->prepare("SELECT id FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    set_flash("danger", "Contact introuvable.");
    header("Location: index.php");
    exit;
}

// Supprimer
$stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->execute([$id]);

set_flash("success", "Contact supprimé avec succès.");
header("Location: index.php");
exit;