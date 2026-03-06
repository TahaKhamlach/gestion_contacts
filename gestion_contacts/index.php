<?php
require_once __DIR__ . "/includes/init.php";

// Pagination
$perPage = 10;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $perPage;

// Tri (liste blanche)
$allowedSort = ["nom", "prenom", "date_creation"];
$sort = $_GET["sort"] ?? "date_creation";
if (!in_array($sort, $allowedSort, true)) $sort = "date_creation";

$order = strtoupper($_GET["order"] ?? "DESC");
if (!in_array($order, ["ASC", "DESC"], true)) $order = "DESC";

// Total contacts
$stmtTotal = $pdo->query("SELECT COUNT(*) AS c FROM contacts");
$total = (int)$stmtTotal->fetch()["c"];
$totalPages = (int)ceil($total / $perPage);
if ($totalPages < 1) $totalPages = 1;
if ($page > $totalPages) $page = $totalPages;

// Charger contacts
$sql = "SELECT * FROM contacts ORDER BY $sort $order LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":limit", $perPage, PDO::PARAM_INT);
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$stmt->execute();
$contacts = $stmt->fetchAll();

require_once __DIR__ . "/includes/header.php";

function sort_link($label, $col, $sort, $order) {
    $newOrder = ($sort === $col && $order === "ASC") ? "DESC" : "ASC";
    return '<a class="text-decoration-none" href="?sort=' . $col . '&order=' . $newOrder . '">' . $label . '</a>';
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="mb-0">Liste des contacts</h3>
  <a class="btn btn-primary" href="ajouter.php">+ Ajouter</a>
</div>

<form method="post" action="exporter.php">
  <input type="hidden" name="mode" value="selection">

  <div class="table-responsive bg-white p-2 rounded">
    <table class="table table-striped align-middle mb-0">
      <thead>
        <tr>
          <th><input type="checkbox" id="checkAll"></th>
          <th><?= sort_link("Nom", "nom", $sort, $order) ?></th>
          <th><?= sort_link("Prénom", "prenom", $sort, $order) ?></th>
          <th>Email</th>
          <th>Téléphone</th>
          <th><?= sort_link("Date d'ajout", "date_creation", $sort, $order) ?></th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($contacts as $c): ?>
        <tr>
          <td>
            <input class="rowCheck" type="checkbox" name="ids[]" value="<?= (int)$c["id"] ?>">
          </td>
          <td><?= htmlspecialchars($c["nom"]) ?></td>
          <td><?= htmlspecialchars($c["prenom"]) ?></td>
          <td><?= htmlspecialchars($c["email"] ?? "") ?></td>
          <td><?= htmlspecialchars($c["telephone"] ?? "") ?></td>
          <td><?= htmlspecialchars($c["date_creation"]) ?></td>
          <td class="d-flex gap-2">
            <a class="btn btn-sm btn-secondary" href="voir.php?id=<?= (int)$c["id"] ?>">Voir</a>
            <a class="btn btn-sm btn-warning" href="modifier.php?id=<?= (int)$c["id"] ?>">Modifier</a>

            <button 
              class="btn btn-sm btn-danger"
              type="submit"
              formaction="supprimer.php"
              name="id"
              value="<?= (int)$c["id"] ?>"
              onclick="return confirm('Supprimer ce contact ?');"
            >
              Supprimer
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-between align-items-center mt-3">
    <button class="btn btn-success" type="submit">Exporter la sélection (CSV)</button>

    <nav>
      <ul class="pagination mb-0">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= ($i === $page) ? "active" : "" ?>">
            <a class="page-link"
               href="?page=<?= $i ?>&sort=<?= htmlspecialchars($sort) ?>&order=<?= htmlspecialchars($order) ?>">
              <?= $i ?>
            </a>
          </li>
        <?php endfor; ?>
      </ul>
    </nav>
  </div>
</form>

<?php require_once __DIR__ . "/includes/footer.php"; ?>