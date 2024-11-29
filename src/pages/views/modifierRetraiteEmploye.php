<?php
require_once 'gererRetraiteEmployes.php'; // Inclure les fonctions pour manipuler la base

// Récupérer l'ID de l'employé à modifier
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Erreur : Aucun identifiant d'employé fourni.");
}

$matricule = $_GET['id'];
$employee = getEmployeeByMatricule($matricule); // Fonction à implémenter pour récupérer l'employé

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données modifiées du formulaire
    $nom = $_POST['nom'];
    $postnom = $_POST['postnom'];
    $dateNaissance = $_POST['date_naissance'];
    $grade = $_POST['grade'];
    $division = $_POST['division'];

    // Appeler la fonction pour mettre à jour l'employé
    $result = updateEmployee($matricule, $nom, $postnom, $dateNaissance, $grade, $division); // Fonction à créer

    if ($result) {
        header("Location: retraiteEmployes.php?message=success");
        exit;
    } else {
        $error = "Erreur lors de la mise à jour des informations.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Modifier les informations de l'employé</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($employee['Nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="postnom" class="form-label">Postnom</label>
            <input type="text" class="form-control" id="postnom" name="postnom" value="<?= htmlspecialchars($employee['PostNom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de Naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?= htmlspecialchars($employee['DateNaissance']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" class="form-control" id="grade" name="grade" value="<?= htmlspecialchars($employee['Grade']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="division" class="form-label">Division</label>
            <input type="text" class="form-control" id="division" name="division" value="<?= htmlspecialchars($employee['NomDivision']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="retraiteEmployes.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
