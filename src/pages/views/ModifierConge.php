<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RHRAD-CONGE</title>
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php
include 'traitement.php';

try {
    $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if (isset($_GET['CongeID'])) {
    $CongeID = $_GET['CongeID'];
    $query = "SELECT p.Nom, p.Postnom, p.Prenom, p.Grade, p.NomDivision, c.CongeID, c.Date_Enregistrement, c.DateDebut, c.DateFin, c.TypeConge, c.Statut
              FROM personnes p
              INNER JOIN conges c ON p.id = c.IdPersonne
              WHERE c.CongeID = :CongeID";

    $stmt = $bdd->prepare($query);
    $stmt->execute(['CongeID' => $CongeID]);
    $conge = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$conge) {
        echo "<p class='text-danger'>Congé non trouvé.</p>";
        exit();
    }
} else {
    echo "<p class='text-danger'>ID de congé non fourni.</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Date_Enregistrement = $_POST['Date_Enregistrement'];
    $DateDebut = $_POST['DateDebut'];
    $DateFin = $_POST['DateFin'];
    $TypeConge = $_POST['TypeConge'];

    // Calculer le statut en fonction des dates
    $today = new DateTime(); // Date actuelle
    $dateDebutObj = new DateTime($DateDebut);
    $dateFinObj = new DateTime($DateFin);

    if ($today < $dateDebutObj) {
        $Statut = "À venir"; // Le congé n'a pas encore commencé
    } elseif ($today >= $dateDebutObj && $today <= $dateFinObj) {
        $Statut = "En cours"; // Le congé est en cours
    } elseif ($today == $dateFinObj) {
        $Statut = "Terminé"; // Le congé se termine aujourd'hui
    } else {
        $Statut = "Terminé"; // Le congé est terminé
    }

    // Mettre à jour le congé dans la base de données avec le statut recalculé
    $updateQuery = "UPDATE conges 
                    SET Date_Enregistrement = :Date_Enregistrement, 
                        DateDebut = :DateDebut, 
                        DateFin = :DateFin, 
                        TypeConge = :TypeConge, 
                        Statut = :Statut 
                    WHERE CongeID = :CongeID";

    $stmt = $bdd->prepare($updateQuery);
    $stmt->execute([
        'Date_Enregistrement' => $Date_Enregistrement,
        'DateDebut' => $DateDebut,
        'DateFin' => $DateFin,
        'TypeConge' => $TypeConge,
        'Statut' => $Statut,
        'CongeID' => $CongeID
    ]);

    header("Location: conges.php");
    exit();
}
?>


<div class="container my-5 py-4">
    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="card-title text-center mb-4"><i class="fas fa-edit"></i> Modifier le Congé</h4>
            <form method="POST">
                <input type="hidden" name="CongeID" value="<?php echo htmlspecialchars($conge['CongeID']); ?>">

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom de l'Employé</label>
                    <input type="text" id="nom" class="form-control" value="<?php echo htmlspecialchars($conge['Nom']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">Postnom et Prénom de l'Employé</label>
                    <input type="text" id="prenom" class="form-control" value="<?php echo htmlspecialchars($conge['Postnom'] . ' ' . $conge['Prenom']); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="Date_Enregistrement" class="form-label">Date d'enregistrement</label>
                    <input type="date" id="Date_Enregistrement" name="Date_Enregistrement" class="form-control" value="<?php echo htmlspecialchars($conge['Date_Enregistrement']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="DateDebut" class="form-label">Date de début</label>
                    <input type="date" id="DateDebut" name="DateDebut" class="form-control" value="<?php echo htmlspecialchars($conge['DateDebut']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="DateFin" class="form-label">Date de fin</label>
                    <input type="date" id="DateFin" name="DateFin" class="form-control" value="<?php echo htmlspecialchars($conge['DateFin']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="TypeConge" class="form-label">Type de congé</label>
                    <select id="TypeConge" name="TypeConge" class="form-control" required>
                        <option value="">Sélectionnez le type de congé</option>
                        <option value="annuel" <?php if ($conge['TypeConge'] == 'annuel') echo 'selected'; ?>>Congé Annuel</option>
                        <option value="maladie" <?php if ($conge['TypeConge'] == 'maladie') echo 'selected'; ?>>Congé de Maladie</option>
                        <option value="maternite" <?php if ($conge['TypeConge'] == 'maternite') echo 'selected'; ?>>Congé de Maternité</option>
                        <option value="mariage" <?php if ($conge['TypeConge'] == 'mariage') echo 'selected'; ?>>Congé de Mariage</option>
                        <option value="autre" <?php if ($conge['TypeConge'] == 'autre') echo 'selected'; ?>>Autre Congé</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="hidden" id="Statut" name="Statut" class="form-control" value="<?php echo htmlspecialchars($conge['Statut']); ?>" placeholder="Statut du congé">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Modifier le Congé</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();"><i class="fas fa-times"></i> Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
