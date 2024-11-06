<?php
include_once('traitement.php');

$traitement = new traitement();
$employe = null;

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = intval($_POST['id']);
        if ($id > 0) {
                $matricule = $_POST['matricule'];
                $nom = $_POST['nom'];
                $postnom = $_POST['postnom'];
                $prenom = $_POST['prenom'];
                $grade = $_POST['grade'];
                $division = $_POST['division'];
                $genre = $_POST['genre'];
                $dateNaissance = $_POST['date_naissance'];
                $numTelephone = $_POST['num_telephone'];
                $remuneration = $_POST['remuneration'];
                $refAffectation = $_POST['ref_affectation'];
                $refEngagement = $_POST['ref_engagement'];

                try {
                        $conn = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $requete = "UPDATE personnes SET matricule=?, nom=?, postnom=?, prenom=?, grade=?, NomDivision=?, genre=?, dateNaissance=?, numTelephone=?, remuneration=?, ref_doc_Affectation=?, ref_acteEngagement=? WHERE id=?";
                        $params = array($matricule, $nom, $postnom, $prenom, $grade, $division, $genre, $dateNaissance, $numTelephone, $remuneration, $refAffectation, $refEngagement, $id);

                        $stmt = $conn->prepare($requete);
                        $stmt->execute($params);

                        if ($stmt->rowCount() > 0) {
                                header('Location: ajouter_Modifier_Employes_RH.php');
                                exit();
                        } else {
                                echo 'Aucune modification n\'a été effectuée.';
                        }
                } catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                }
        } else {
                echo "ID invalide.";
        }
} else {
        echo "ID invalide.";
}
?>
