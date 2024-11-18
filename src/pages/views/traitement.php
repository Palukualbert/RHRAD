<?php
class traitement
{

    // Fonction pour rechercher une personne par matricule ou nom
    public function search($matricule = '', $nom = '')
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "SELECT id,Matricule, Nom, Postnom, Prenom, DateNaissance, NumTelephone, NomDivision, Remuneration, Genre,Grade FROM personnes WHERE matricule = :matricule OR nom = :nom";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([
            'matricule' => $matricule,
            'nom' => $nom
        ]);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function search_prime($matricule = '', $nom = '')
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "SELECT p.Matricule, p.Nom, p.Postnom, p.Prenom, p.Grade, p.NomDivision, p.Remuneration, pr.prime,pr.date_remuneration,pr.nombre_jours_prestes 
            FROM personnes p
            INNER JOIN prime pr ON p.id = pr.id_personne
            WHERE matricule = :matricule OR nom = :nom";
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
    public function getByMatricule($matricule)
    {
        $conn = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $stmt = $conn->prepare('SELECT id FROM personnes WHERE matricule = :matricule');
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR); // Garde PDO::PARAM_STR pour un matricule alphanumérique
        $stmt->execute();
        $employe = $stmt->fetch(PDO::FETCH_ASSOC);

        // Retourner directement l'ID en tant qu'entier ou null s'il n'existe pas
        return $employe ? (int) $employe['id'] : null;
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
    public function calculerPrime($grade, $joursPrestes) {
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
            case 'Encodeur_RH':
                $salaireJournalier = 6000;
                break;
            case 'Encodeur_CONGES':

            case 'Encodeur_POSTES':

            case 'Encodeur_REMUN':
                $salaireJournalier = 5000;
                break;
            default:
                $salaireJournalier = 4000;
        }

        // Calcul de la prime
         $prime = $salaireJournalier * $joursPrestes;
        //$prime = $salaireMensuel - $total_salaire_journalier;
        return $prime;
    }
    public function insert_prime($prime, $date_remuneration, $nombre_jours_prestes, $id_personne)
    {
        // Vérifiez que $id_personne est un entier valide
        if (!is_int($id_personne)) {
            throw new InvalidArgumentException("L'ID de la personne doit être un entier.");
        }

        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "INSERT INTO prime (prime, date_remuneration, nombre_jours_prestes, id_personne)
            VALUES (:prime, :date_remuneration, :nombre_jours_prestes, :id_personne)";
        $stmt = $bdd->prepare($sql);

        // Exécutez la requête en vérifiant les valeurs
        $stmt->execute([
            'prime' => $prime,
            'date_remuneration' => $date_remuneration,
            'nombre_jours_prestes' => $nombre_jours_prestes,
            'id_personne' => $id_personne
        ]);

        return true;
    }

    public function getPersonnesAvecPrimes()
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "SELECT p.Matricule,p.Nom, p.Postnom, p.Grade, p.NomDivision, p.Remuneration, pr.prime,pr.date_remuneration,pr.nombre_jours_prestes 
            FROM personnes p
            INNER JOIN prime pr ON p.id = pr.id_personne
            WHERE pr.prime IS NOT NULL";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        header("Location: PrimeEmployes.php");
    }
    // Fonction pour ajouter un congé
    public function ajouter_conge($Matricule, $Date_Enregistrement, $DateDebut, $DateFin, $TypeConge)
    {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si la personne existe en recherchant par matricule
            $stmtPersonne = $bdd->prepare("SELECT id FROM personnes WHERE Matricule = :Matricule");
            $stmtPersonne->execute(['Matricule' => $Matricule]);
            $personne = $stmtPersonne->fetch(PDO::FETCH_ASSOC);

            if (!$personne) {
                throw new Exception("Employé avec le matricule {$Matricule} non trouvé.");
            }
            // Calculer le statut du congé
            $today = new DateTime(); // Date actuelle
            $dateDebutObj = new DateTime($DateDebut);
            $dateFinObj = new DateTime($DateFin);

            if ($today < $dateDebutObj) {
                $Statut = "À venir"; // Le congé n'a pas encore commencé
            } elseif ($today >= $dateDebutObj && $today <= $dateFinObj) {
                $Statut = "En cours"; // Le congé est en cours
            }elseif ($today == $dateFinObj) {
                $Statut = "Terminé"; // Le congé se termine aujourd'hui
            } else {
                $Statut = "Terminé"; // Le congé est terminé
            }
            // Insérer le congé dans la table `conges`
            $stmtConge = $bdd->prepare("INSERT INTO conges (Date_Enregistrement,DateDebut, DateFin, TypeConge, Statut, IdPersonne) VALUES (:Date_Enregistrement,:DateDebut, :DateFin, :TypeConge, :Statut, :IdPersonne)");
            $stmtConge->execute([
                'Date_Enregistrement' => $Date_Enregistrement,
                'DateDebut' => $DateDebut,
                'DateFin' => $DateFin,
                'TypeConge' => $TypeConge,
                'Statut' => $Statut,
                'IdPersonne' => $personne['id']
            ]);

            return true;
        } catch (Exception $e) {
            // Gérer les erreurs si nécessaire
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
    public function getpersonnesConge()
    {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $sql = "SELECT p.Nom, p.Postnom, p.Prenom, p.Grade, p.NomDivision,c.CongeID, c.Date_Enregistrement,c.DateDebut,c.DateFin,c.TypeConge,c.Statut 
            FROM personnes p
            INNER JOIN conges c ON p.id = c.IdPersonne ORDER BY Date_Enregistrement";
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        //header("Location: PrimeEmployes.php");
    }
    public function searchPersonneConge() {
        $bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
        $searchNom = $_GET['Nom'] ?? null;
        $searchDate = $_GET['Date_Enregistrement'] ?? null;

        // Requête SQL avec jointure
        $query = "SELECT c.*, p.Nom, p.Postnom, p.Grade, p.NomDivision 
              FROM conges c 
              JOIN personnes p ON c.IdPersonne = p.id 
              WHERE 1=1";
        if ($searchNom) {
            $query .= " AND Nom LIKE :Nom";
        }

        if ($searchDate) {
            $query .= " AND Date_Enregistrement = :Date_Enregistrement";
        }

        $stmt = $bdd->prepare($query);

        if ($searchNom) {
            $stmt->bindValue(':Nom', '%' . $searchNom . '%');
        }

        if ($searchDate) {
            $stmt->bindValue(':Date_Enregistrement', $searchDate);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function joursRestantsCongé($DateDebut, $DateFin)
    {
        try {
            // Convertir $DateDebut et $DateFin en objets DateTime
            $dateDebutObj = new DateTime($DateDebut);
            $dateFinObj = new DateTime($DateFin);
            $today = new DateTime(); // Date actuelle

            // Vérifier si le congé n'a pas encore débuté
            if ($today < $dateDebutObj) {
                return "Non débuté";
            }

            // Vérifier si la date de fin est déjà passée
            if ($today > $dateFinObj) {
                return "0 Jour"; // Le congé est terminé, donc aucun jour restant
            }

            // Ajouter un jour à la date de fin pour inclure la journée de fin
            $dateFinObj->modify('+1 day');

            // Calculer la différence entre aujourd'hui et la date de fin
            $interval = $today->diff($dateFinObj);

            // Si l'intervalle en jours est 1 mais qu'il reste des heures, afficher "1 Jour"
            if ($interval->days == 1 && ($interval->h > 0 || $interval->i > 0)) {
                return "1 Jour";
            }

            // Retourner le nombre de jours restants
            return $interval->days . " Jours";
        } catch (Exception $e) {
            // Gérer les erreurs si nécessaire
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }



}
?>
