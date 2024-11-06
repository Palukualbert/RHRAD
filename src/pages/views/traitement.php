<?php
class traitement
{

    // Fonction pour rechercher une personne par matricule ou nom
    public function search($matricule = '', $nom = '')
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "SELECT id,Matricule, Nom, Postnom, Prenom, DateNaissance, NumTelephone, NomDivision, Remuneration, Genre FROM personnes WHERE matricule = :matricule OR nom = :nom";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'matricule' => $matricule,
            'nom' => $nom
        ]);
        $result = $stmt->fetchAll();
        return $result;
    }

    // Récupérer un employé par ID
    public function getById($id)
    {
        $conn = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $stmt = $conn->prepare('SELECT * FROM personnes WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $employe = $result->fetch_assoc();
        $stmt->close();
        return $employe;
    }

    // Fonction pour modifier les informations d'une personne
    public function update($id, $matricule, $nom, $postnom, $prenom, $dateNaissance, $numTelephone, $nomDivision, $remuneration, $genre, $grade, $refAffectation, $refEngagement)
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "UPDATE personnes SET matricule = :matricule, nom = :nom, postnom = :postnom, prenom = :prenom, dateNaissance = :dateNaissance, numTelephone = :numTelephone, nomDivision = :nomDivision, remuneration = :remuneration, genre = :genre, grade = :grade, ref_affectation = :refAffectation, ref_engagement = :refEngagement WHERE id = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'matricule' => $matricule,
            'nom' => $nom,
            'postnom' => $postnom,
            'prenom' => $prenom,
            'dateNaissance' => $dateNaissance,
            'numTelephone' => $numTelephone,
            'nomDivision' => $nomDivision,
            'remuneration' => $remuneration,
            'genre' => $genre,
            'grade' => $grade,
            'refAffectation' => $refAffectation,
            'refEngagement' => $refEngagement
        ]);
        return true;
    }

    // Fonction pour lire toutes les personnes
    public function read()
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "SELECT id,Matricule, Nom, Postnom, Prenom, DateNaissance, NumTelephone, NomDivision, Remuneration, Genre,Grade FROM personnes ORDER BY id ASC";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // Fonction pour supprimer une personne
    public function delete($id)
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = 'DELETE FROM personnes WHERE id = :id';
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function insert($matricule, $nom, $postnom, $prenom, $dateNaissance, $numTelephone, $division, $refDocEngagement, $refDocAffectation, $remuneration, $genre, $grade)
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "INSERT INTO personnes (Matricule, Nom, PostNom, Prenom, DateNaissance, NumTelephone, NomDivision, Ref_acteEngagement, Ref_doc_Affectation, Remuneration, Genre, Grade)
            VALUES (:matricule, :nom, :postnom, :prenom, :dateNaissance, :numTelephone, :division, :refDocEngagement, :refDocAffectation, :remuneration, :genre, :grade)";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'matricule' => $matricule,
            'nom' => $nom,
            'postnom' => $postnom,
            'prenom' => $prenom,
            'dateNaissance' => $dateNaissance,
            'numTelephone' => $numTelephone,
            'division' => $division,
            'refDocEngagement' => $refDocEngagement,
            'refDocAffectation' => $refDocAffectation,
            'remuneration' => $remuneration,
            'genre' => $genre,
            'grade' => $grade
        ]);
        return true;
    }


// Fonction pour calculer la prime
    public function calculerPrime($matricule, $grade, $joursPrestes, $salaireMensuel) {
        // Déterminer le salaire journalier en fonction du grade
        switch ($grade) {
            case 'DP':
                $salaireJournalier = 15000;
                break;
            case 'CD':
                $salaireJournalier = 10000;
                break;
            case 'CB':
                $salaireJournalier = 8000;
                break;
            default:
                $salaireJournalier = 5000;
        }

        // Calcul de la prime
        $total_salaire_journalier = $salaireJournalier * $joursPrestes;
        $prime = $salaireMensuel - $total_salaire_journalier;

        return [
            'matricule' => $matricule,
            'prime' => $prime,
        ];
    }
}
?>
