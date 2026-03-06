<?php
require_once __DIR__ . "/includes/init.php";

$errors = [];
$nom = $prenom = $email = $telephone = $adresse = $date_naissance = $notes = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $prenom = trim($_POST["prenom"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telephone = trim($_POST["telephone"] ?? "");
    $adresse = trim($_POST["adresse"] ?? "");
    $date_naissance = trim($_POST["date_naissance"] ?? "");
    $notes = trim($_POST["notes"] ?? "");

    // Validation serveur (obligatoire)
    if ($nom === "") $errors["nom"] = "Nom obligatoire";
    if ($prenom === "") $errors["prenom"] = "Prénom obligatoire";

    if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Email invalide";
    }

    // Unicité email (si email non vide)
    if (!isset($errors["email"]) && $email !== "") {
        $st = $pdo->prepare("SELECT COUNT(*) AS c FROM contacts WHERE email = ?");
        $st->execute([$email]);
        if ((int)$st->fetch()["c"] > 0) {
            $errors["email"] = "Email déjà utilisé";
        }
    }

    // Insert si OK
    if (!$errors) {
        $st = $pdo->prepare("
            INSERT INTO contacts (nom, prenom, email, telephone, adresse, date_naissance, notes)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $st->execute([
            $nom,
            $prenom,
            ($email === "" ? null : $email),
            ($telephone === "" ? null : $telephone),
            ($adresse === "" ? null : $adresse),
            ($date_naissance === "" ? null : $date_naissance),
            ($notes === "" ? null : $notes)
        ]);

        set_flash("success", "Contact ajouté avec succès.");
        header("Location: index.php");
        exit;
    }
}

require_once __DIR__ . "/includes/header.php";
?>

<h3>Ajouter un contact</h3>

<form method="post" class="bg-white p-3 rounded needs-validation" novalidate>
  <div class="row g-3">

    <div class="col-md-6">
      <label class="form-label">Nom *</label>
      <input name="nom" class="form-control <?= isset($errors["nom"]) ? "is-invalid" : "" ?>"
             value="<?= htmlspecialchars($nom) ?>" required>
      <div class="invalid-feedback">
        <?= htmlspecialchars($errors["nom"] ?? "Champ obligatoire") ?>
      </div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Prénom *</label>
      <input name="prenom" class="form-control <?= isset($errors["prenom"]) ? "is-invalid" : "" ?>"
             value="<?= htmlspecialchars($prenom) ?>" required>
      <div class="invalid-feedback">
        <?= htmlspecialchars($errors["prenom"] ?? "Champ obligatoire") ?>
      </div>
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email"
             class="form-control <?= isset($errors["email"]) ? "is-invalid" : "" ?>"
             value="<?= htmlspecialchars($email) ?>">
      <div class="invalid-feedback">
        <?= htmlspecialchars($errors["email"] ?? "Email invalide") ?>
      </div>
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
      <a class="btn btn-secondary" href="index.php">Annuler</a>
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