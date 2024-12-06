<?php
// Inclure la page de connexion à la base de données
include 'connexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])) {
    $matricule = $_POST["matricule"];
    $password = $_POST["password"];
    $grade = $_POST["grade"];

    // Vérifier que le grade est valide
    $valid_grades = ['ENCODEUR_RH', 'ENCODEUR_CONGES', 'ENCODEUR_REMUNERATION', 'ENCODEUR_POSTE', 'DP', 'ASG'];
    if (!in_array($grade, $valid_grades)) {
        echo "Grade invalide.";
        exit();
    }

    try {
        // Vérifier si l'utilisateur est déjà enregistré
        $bdd = new  PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $stmt = $bdd->prepare("SELECT * FROM Personnes WHERE matricule = :matricule");
        $stmt->execute(['matricule' => $matricule]);
        $user = $stmt->fetch();

        if ($user) {
            // Vérifier les informations de connexion
            if ($user['password'] == $password && $user['Grade'] == $grade) {

                switch ($grade) {
                    case 'ENCODEUR_RH':
                        header("Location: encodeur_RH.php");
                    case 'ENCODEUR_CONGES':
                        header("Location: encodeur_CONGES.php");
                        break;
                    case 'ENCODEUR_REMUNERATION':
                        header("Location: encodeur_REMUN.php");
                        break;
                    case 'ENCODEUR_POSTE':
                        header("Location: encodeur_POSTES.php");
                        break;
                    case 'DP':
                        header("Location: consultationProfils.php");

                    case 'ASG':
                        header("Location: consultationProfils.php");
                        break;
                    default:
                        header("Location: login.php");
                        break;
                }
                exit();

            }else {
                    header("Location: login.php?error=1");
                    exit();
                }
            }

    } catch (PDOException $e) {
        echo 'Requête échouée: ' . $e->getMessage();
    }
}
?>
