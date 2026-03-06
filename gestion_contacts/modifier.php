<?php
require_once __DIR__ . "/includes/init.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) {
    set_flash("danger", "ID invalide.");
    header("Location: index.php");
    exit;
}

// Charger le contact
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch();

if (!$contact) {
    set_flash("danger", "Contact introuvable.");
    header("Location: index.php");
    exit;
}

$errors = [];
$nom = $contact["nom"];
$prenom = $contact["prenom"];
$email = $contact["email"] ?? "";
$telephone = $contact["telephone"] ?? "";
$adresse = $contact["adresse"] ?? "";
$date_naissance = $contact["date_naissance"] ?? "";
$notes = $contact["notes"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $prenom = trim($_POST["prenom"] ?? "");
    $newEmail = trim($_POST["email"] ?? "");
    $telephone = trim($_POST["telephone"] ?? "");
    $adresse = trim($_POST["adresse"] ?? "");
    $date_naissance = trim($_POST["date_naissance"] ?? "");
    $notes = trim($_POST["notes"] ?? "");

    // Validation serveur
    if ($nom === "") $errors["nom"] = "Nom obligatoire";
    if ($prenom === "") $errors["prenom"] = "Prénom obligatoire";

    if ($newEmail !== "" && !filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email invalide";
    }

    // Unicité email seulement si changé et non vide
    $oldEmail = $email; // email actuel en base
    if (!isset($errors["email"]) && $newEmail !== "" && $newEmail !== $oldEmail) {
        $st = $pdo->prepare("SELECT COUNT(*) AS c FROM contacts WHERE email = ? AND id <> ?");
        $st->execute([$newEmail, $id]);
        if ((int)$st->fetch()["c"] > 0) {
            $errors["email"] = "Email déjà utilisé";
        }
    }

    if (!$errors) {
        $stmt = $pdo->prepare("
            UPDATE contacts
            SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?, date_naissance = ?, notes = ?
            WHERE id = ?
        ");
        $stmt->execute([
            $nom,
            $prenom,
            ($newEmail === "" ? null : $newEmail),
            ($telephone === "" ? null : $telephone),
            ($adresse === "" ? null : $adresse),
            ($date_naissance === "" ? null : $date_naissance),
            ($notes === "" ? null : $notes),
            $id
        ]);

        set_flash("success", "Contact modifié avec succès.");
        header("Location: voir.php?id=" . $id);
        exit;
    }

    // garder la valeur affichée
    $email = $newEmail;
}

require_once __DIR__ . "/includes/header.php";
?>

<h3>Modifier un contact</h3>

<form method="post" class="bg-white p-3 rounded needs-validation" novalidate>
  <div class="row g-3">

    <div class="col-md-6">
      <label class="form-label">Nom *</label>
      <input name="nom" class="form-control <?= isset($errors["nom"]) ? "is-invalid" : "" ?>"
             value="<?= htmlspecialchars($nom) ?>" required>
      <div class="invalid-feedback"><?= htmlspecialchars($errors["nom"] ?? "Champ obligatoire") ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Prénom *</label>
      <input name="prenom" class="form-control <?= isset($errors["prenom"]) ? "is-invalid" : "" ?>"
             value="<?= htmlspecialchars($prenom) ?>" required>
      <div class="invalid-feedback"><?= htmlspecialchars($errors["prenom"] ?? "Champ obligatoire") ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email"
             class="form-control <?= isset($errors["email"]) ? "is-invalid" : "" ?>"
             value="<?= htmlspecialchars($email) ?>">
      <div class="invalid-feedback"><?= htmlspecialchars($errors["email"] ?? "Email invalide") ?></div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Téléphone</label>
      <input name="telephone" class="form-control" value="<?= htmlspecialchars($telephone) ?>">
    </div>

    <div class="col-12">
      <label class="form-label">Adresse</label>
      <textarea name="adresse" class="form-control" rows="2"><?= htmlspecialchars($adresse) ?></textarea>
    </div>

    <div class="col-md-6">
      <label class="form-label">Date de naissance</label>
      <input type="date" name="date_naissance" class="form-control"
             value="<?= htmlspecialchars($date_naissance) ?>">
    </div>

    <div class="col-12">
      <label class="form-label">Notes</label>
      <textarea name="notes" class="form-control" rows="3"><?= htmlspecialchars($notes) ?></textarea>
    </div>

    <div class="col-12 d-flex gap-2">
      <button class="btn btn-primary" type="submit">Enregistrer</button>
      <a class="btn btn-secondary" href="voir.php?id=<?= (int)$id ?>">Annuler</a>
    </div>

  </div>
</form>

<script>
(() => {
  const form = document.querySelector(".needs-validation");
  form.addEventListener("submit", (e) => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
    }
    form.classList.add("was-validated");
  });
})();
</script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>