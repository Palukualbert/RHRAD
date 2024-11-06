<?php
// Inclure la page de connexion à la base de données
include 'connexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])) {
    $matricule = strtoupper(trim($_POST["matricule"]));
    $password = trim($_POST["password"]);
    $grade = strtoupper(trim($_POST["grade"]));

    // Vérifier que le grade est valide
    $valid_grades = ['ENCODEUR_RH', 'ENCODEUR_CONGES', 'ENCODEUR_REMUNERATION', 'ENCODEUR_POSTE', 'DP', 'ASG'];
    if (!in_array($grade, $valid_grades)) {
        echo "Grade invalide.";
        exit();
    }

    try {
        // Vérifier si l'utilisateur est déjà enregistré
        $stmt = $pdo->prepare("SELECT * FROM Admin WHERE matricule = :matricule");
        $stmt->execute(['matricule' => $matricule]);
        $user = $stmt->fetch();

        if ($user) {
            // Vérifier les informations de connexion
            if ($user['password'] == $password) {
                // Rediriger l'utilisateur en fonction de son grade
                switch ($grade) {
                    case 'ENCODEUR_RH':
                        header("Location: encodeur_RH.php");
                        break;
                    case 'ENCODEUR_CONGES':
                        header("Location: encodeur_Conges.php");
                        break;
                    case 'ENCODEUR_REMUNERATION':
                        header("Location: encodeur_Remuneration.php");
                        break;
                    case 'ENCODEUR_POSTE':
                        header("Location: encodeur_Postes.php");
                        break;
                    case 'DP':
                    case 'ASG':
                        header("Location: consultationProfil.php");
                        break;
                    default:
                        header("Location: index.php");
                        break;
                }
                exit();
            } else {
                echo "Matricule ou mot de passe incorrect.";
                exit();
            }
        } else {
            // Ajouter l'utilisateur dans la base de données
            $stmt = $pdo->prepare("INSERT INTO Admin (matricule, password, grade) VALUES (:matricule, :password, :grade)");
            $stmt->execute(['matricule' => $matricule, 'password' => $password, 'grade' => $grade]);

            // Rediriger l'utilisateur en fonction de son grade après ajout
            switch ($grade) {
                case 'ENCODEUR_RH':
                    header("Location: encodeur_RH.php");
                    break;
                case 'ENCODEUR_CONGES':
                    header("Location: encodeur_Conges.php");
                    break;
                case 'ENCODEUR_REMUNERATION':
                    header("Location: encodeur_Remuneration.php");
                    break;
                case 'ENCODEUR_POSTE':
                    header("Location: encodeur_Postes.php");
                    break;
                case 'DP':
                case 'ASG':
                    header("Location: consultationProfil.php");
                    break;
                default:
                    header("Location: index.php");
                    break;
            }
            exit();
        }
    } catch (PDOException $e) {
        echo 'Requête échouée: ' . $e->getMessage();
    }
}
?>
