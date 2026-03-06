<?php
require_once __DIR__ . "/includes/init.php";

// Mode : tout (GET) ou sélection (POST)
$mode = $_POST["mode"] ?? ($_GET["mode"] ?? "tout");

// Récupérer les contacts selon le mode
if ($mode === "selection") {
    $ids = $_POST["ids"] ?? [];
    if (!is_array($ids) || count($ids) === 0) {
        set_flash("danger", "Aucun contact sélectionné pour l'export.");
        header("Location: index.php");
        exit;
    }

    // Nettoyer ids (int > 0)
    $cleanIds = [];
    foreach ($ids as $id) {
        $id = (int)$id;
        if ($id > 0) $cleanIds[] = $id;
    }

    if (count($cleanIds) === 0) {
        set_flash("danger", "Sélection invalide.");
        header("Location: index.php");
        exit;
    }

    // IN (...) sécurisé
    $placeholders = implode(",", array_fill(0, count($cleanIds), "?"));
    $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id IN ($placeholders) ORDER BY nom ASC");
    $stmt->execute($cleanIds);
    $contacts = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM contacts ORDER BY nom ASC");
    $contacts = $stmt->fetchAll();
}

// Forcer téléchargement CSV
$filename = ($mode === "selection") ? "contacts_selection.csv" : "contacts_tous.csv";
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Output CSV
$out = fopen("php://output", "w");

// En-têtes CSV
fputcsv($out, ["id","nom","prenom","email","telephone","adresse","date_naissance","notes","date_creation","date_modification"]);

foreach ($contacts as $c) {
    fputcsv($out, [
        $c["id"],
        $c["nom"],
        $c["prenom"],
        $c["email"],
        $c["telephone"],
        $c["adresse"],
        $c["date_naissance"],
        $c["notes"],
        $c["date_creation"],
        $c["date_modification"]
    ]);
}

fclose($out);
exit;