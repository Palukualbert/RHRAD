<?php
// Connexion à la base de données
$dbname = "gestion_rh";
$conn = mysqli_connect("localhost", "root", "", $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si un ID a été passé
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Requête pour récupérer les informations du poste et le matricule associé
    $sql = "SELECT historique_postes.Grade, historique_postes.Date_debut, historique_postes.Date_fin, 
                   personnes.Matricule 
            FROM historique_postes
            INNER JOIN personnes ON historique_postes.IdPersonne = personnes.id
            WHERE historique_postes.id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $poste = $result->fetch_assoc();
    } else {
        die("Poste non trouvé.");
    }
} else {
    die("ID du poste manquant.");
}

// Mise à jour du poste
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade = mysqli_real_escape_string($conn, $_POST['grade']);
    $date_debut = mysqli_real_escape_string($conn, $_POST['date_debut']);
    $date_fin = mysqli_real_escape_string($conn, $_POST['date_fin']);

    // Mettre à jour les informations dans la base de données
    $update_sql = "UPDATE historique_postes 
                   SET Grade = '$grade', Date_debut = '$date_debut', Date_fin = '$date_fin' 
                   WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: encodeur_POSTES.php"); // Redirection après mise à jour
        exit;
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Poste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Modifier le Poste</h1>
    <form method="POST">
        <!-- Matricule (readonly) -->
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule</label>
            <input type="text" class="form-control" id="matricule" name="matricule" value="<?= htmlspecialchars($poste['Matricule']) ?>" readonly>
        </div>

        <!-- Grade -->
        <div class="mb-3">
            <label for="grade" class="form-label">Grade</label>
            <input type="text" class="form-control" id="grade" name="grade" value="<?= htmlspecialchars($poste['Grade']) ?>" required>
        </div>

        <!-- Date Début -->
        <div class="mb-3">
            <label for="date_debut" class="form-label">Date Début</label>
            <input type="date" class="form-control" id="date_debut" name="date_debut" value="<?= htmlspecialchars($poste['Date_debut']) ?>" required>
        </div>

        <!-- Date Fin -->
        <div class="mb-3">
            <label for="date_fin" class="form-label">Date Fin</label>
            <input type="date" class="form-control" id="date_fin" name="date_fin" value="<?= htmlspecialchars($poste['Date_fin']) ?>">
        </div>

        <!-- Boutons -->
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="historique_postes.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>
