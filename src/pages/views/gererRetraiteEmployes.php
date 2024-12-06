<?php
require_once 'connexiondb.php';

/**
 * Fonction pour récupérer les employés qui doivent être en retraite
 * Critères : Age >= 65 ou Années de service >= 35
 *
 * @return array Liste des employés en retraite
 */
function getRetraiteEmployees() {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh","root","");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour sélectionner les employés en retraite
        $query = "
                SELECT 
                    personnes.Matricule, 
                    personnes.Nom, 
                    personnes.PostNom, 
                    personnes.DateNaissance,
                    TIMESTAMPDIFF(YEAR, personnes.DateNaissance, CURDATE()) AS Age, -- Âge actuel
                    retraite.AnneesService, 
                    personnes.Grade,  
                    personnes.NomDivision,
                    retraite.AgeRetraite,
                    retraite.IdPersonne,
                    CURDATE() AS DateDebutRetraite,
                    retraite.Date_Enregistrement -- Date d'enregistrement si elle existe
                FROM 
                    retraite
                INNER JOIN 
                    personnes ON retraite.IdPersonne = personnes.Id
                WHERE 
                    TIMESTAMPDIFF(YEAR, personnes.DateNaissance, CURDATE()) >= 65 -- Condition pour l'âge
                    OR retraite.AnneesService >= 35 -- Condition pour les années de service
            ";
        // Préparation et exécution
        $stmt = $bdd->prepare($query);
        $stmt->execute();

        // Retourner les résultats sous forme de tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
function insertRetraiteEmployes($matricule, $dateEnregistrement, $dateDebut) {
    try {
        // Connexion à la base de données
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les informations de la personne en fonction du matricule
        $query = "
            SELECT 
                Id AS IdPersonne, 
                DateNaissance, 
                AnneeEngagement 
            FROM 
                personnes 
            WHERE 
                Matricule = :matricule
        ";
        $stmt = $bdd->prepare($query);
        $stmt->execute([':matricule' => $matricule]);
        $person = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$person) {
            return ['status' => 'error', 'message' => "Aucun employé trouvé avec ce matricule."];
        }

        $idPersonne = $person['IdPersonne'];

        // Vérifier si l'employé existe déjà dans la table retraite
        $checkQuery = "SELECT IdPersonne FROM retraite WHERE IdPersonne = :IdPersonne";
        $checkStmt = $bdd->prepare($checkQuery);
        $checkStmt->execute([':IdPersonne' => $idPersonne]);
        $exists = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($exists) {
            return ['status' => 'warning', 'message' => "Cet employé est déjà à la retraite."];
        }

        // Calculer l'âge et les années de service
        $age = date('Y') - date('Y', strtotime($person['DateNaissance']));
        $anneesService = date('Y') - date('Y', strtotime($person['AnneeEngagement']));

        // Insérer les données dans la table retraite
        $insertQuery = "
            INSERT INTO retraite (IdPersonne, AgeRetraite, AnneesService, Date_Enregistrement, DateDebutRetraite) 
            VALUES (:IdPersonne, :AgeRetraite, :AnneesService, :DateEnregistrement, :DateDebutRetraite)
        ";
        $insertStmt = $bdd->prepare($insertQuery);
        $insertStmt->execute([
            ':IdPersonne' => $idPersonne,
            ':AgeRetraite' => $age,
            ':AnneesService' => $anneesService,
            ':DateEnregistrement' => $dateEnregistrement,
            ':DateDebutRetraite' => $dateDebut,
        ]);

        return ['status' => 'success', 'message' => "L'employé a été ajouté avec succès à la liste des retraités."];
    } catch (Exception $e) {
        return ['status' => 'error', 'message' => "Erreur : " . $e->getMessage()];
    }
}
//**
//* Rechercher des employés en retraite par nom, postnom ou matricule.

function searchRetraiteEmployees($searchTerm) {
   try {
       $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
       $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $query = "
           SELECT 
               personnes.Matricule, 
               personnes.Nom, 
               personnes.PostNom, 
               personnes.DateNaissance,
               TIMESTAMPDIFF(YEAR, personnes.DateNaissance, CURDATE()) AS Age,
               personnes.Grade,  
               personnes.NomDivision,
               retraite.Date_Enregistrement,
               retraite.DateDebutRetraite
           FROM retraite
           INNER JOIN personnes ON retraite.IdPersonne = personnes.Id
           WHERE personnes.Matricule LIKE :term 
              OR personnes.Nom LIKE :term 
              OR personnes.PostNom LIKE :term
       ";
       $stmt = $bdd->prepare($query);
       $stmt->execute([':term' => "%$searchTerm%"]);
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
   } catch (PDOException $e) {
       die("Erreur : " . $e->getMessage());
   }
}
function getEmployeeByMatricule($matricule) {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $bdd->prepare("SELECT * FROM personnes WHERE Matricule = ?");
        $stmt->execute([$matricule]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

function updateEmployee($matricule, $nom, $postnom, $dateNaissance, $grade, $division) {
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $bdd->prepare("UPDATE personnes 
                              SET Nom = ?, PostNom = ?, DateNaissance = ?, Grade = ?, NomDivision = ?
                              WHERE Matricule = ?");
        return $stmt->execute([$nom, $postnom, $dateNaissance, $grade, $division, $matricule]);
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

?>
