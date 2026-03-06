<?php
require_once __DIR__ . "/../includes/init.php";

$q = trim($_GET["q"] ?? "");
$like = "%" . $q . "%";

if ($q === "") {
    $stmt = $pdo->query("SELECT * FROM contacts ORDER BY date_creation DESC LIMIT 50");
} else {
    $stmt = $pdo->prepare("
        SELECT * FROM contacts
        WHERE nom LIKE ?
           OR prenom LIKE ?
           OR email LIKE ?
           OR telephone LIKE ?
        ORDER BY date_creation DESC
        LIMIT 50
    ");
    $stmt->execute([$like, $like, $like, $like]);
}

$contacts = $stmt->fetchAll();
?>

<div class="table-responsive">
  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($contacts as $c): ?>
      <tr>
        <td><?= htmlspecialchars($c["nom"]) ?></td>
        <td><?= htmlspecialchars($c["prenom"]) ?></td>
        <td><?= htmlspecialchars($c["email"] ?? "") ?></td>
        <td><?= htmlspecialchars($c["telephone"] ?? "") ?></td>
        <td class="d-flex gap-2">
          <a class="btn btn-sm btn-secondary" href="../voir.php?id=<?= (int)$c["id"] ?>">Voir</a>
          <a class="btn btn-sm btn-warning" href="../modifier.php?id=<?= (int)$c["id"] ?>">Modifier</a>
          <form method="post" action="../supprimer.php" onsubmit="return confirm('Supprimer ce contact ?');">
            <input type="hidden" name="id" value="<?= (int)$c["id"] ?>">
            <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>