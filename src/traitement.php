<?php
class traitement
{
    private $bdd;

    // Constructeur pour initialiser la connexion PDO
    public function __construct()
    {
        try {
            $this->bdd = new PDO("mysql:host=localhost;dbname=gestion_rh", "root", "");
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Fonction pour rechercher une personne par matricule ou nom
    public function search($matricule = '', $nom = '')
    {
        $sql = "SELECT id, Matricule, Nom, Postnom, Prenom, DateNaissance, NumTelephone, NomDivision, Remuneration, Genre 
                FROM personnes 
                WHERE matricule = :matricule OR nom = :nom";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([
            'matricule' => $matricule,
            'nom' => $nom
        ]);
        return $stmt->fetchAll();
    }

    // Récupérer un employé par ID
    public function getById($id)
    {
        $sql = "SELECT * FROM personnes WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getEncodeurByMatricule($matricule)
    {
        $sql = "SELECT p.Matricule, p.Nom, p.PostNom, p.Prenom, p.Grade, n.status
                FROM Personnes p
                INNER JOIN Notifications n ON n.personne_id = p.id
                WHERE p.Matricule = :matricule";

        try {
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute(['matricule' => $matricule]);

            // Vérifier si l'encodeur existe et retourner les informations
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur dans la récupération des données : " . $e->getMessage();
            return false;
        }
    } // <-- Ajoutez cette accolade de fermeture ici

    // Fonction pour récupérer les notifications en attente
    public function getNotificationsEnAttente()
    {
        $sql = "SELECT p.Matricule, p.Nom, p.PostNom, p.Prenom, p.Grade, n.date_demande, n.id AS notification_id
                FROM Personnes p
                INNER JOIN Notifications n ON n.personne_id = p.id
                WHERE n.status = 'en_attente'";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute();

        // Vérifier si des résultats ont été trouvés
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return []; 
        }
    }

    // Fonction pour approuver ou refuser une notification
    public function gererNotification($notificationId, $action)
    {
        $status = $action === "approuver" ? 'approuvée' : ($action === "refuser" ? 'refusée' : null);
        if (!$status) return false;

        $sql = "UPDATE Notifications SET status = :status WHERE id = :notification_id";
        $stmt = $this->bdd->prepare($sql);
        $stmt->execute([
            'status' => $status,
            'notification_id' => $notificationId
        ]);

        return true;
    }
        // Fonction pour vérifier l'état de la demande de connexion
        private function verifierDemandeConnexion($personId) {
            $sql = "SELECT status, date_demande FROM Notifications WHERE personne_id = :person_id ORDER BY date_demande DESC LIMIT 1";
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute(['person_id' => $personId]);
            $demande = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($demande) {
                $dateDemande = strtotime($demande['date_demande']);
                $now = time();
                $diff = $now - $dateDemande;

                if ($demande['status'] === 'approuvée') {
                    return 'approuvée';
                } elseif ($demande['status'] === 'en_attente' && $diff <= 86400) { // 24 heures
                    return 'en_attente';
                } elseif ($diff > 86400) {
                    // Mettre à jour la demande comme expirée si elle a plus de 24 heures
                    $sqlExpire = "UPDATE Notifications SET status = 'expiré' WHERE personne_id = :person_id";
                    $stmtExpire = $this->bdd->prepare($sqlExpire);
                    $stmtExpire->execute(['person_id' => $personId]);
                    return 'expiré';
                }
            }
            return 'aucune_demande';
        }

        // Fonction pour rediriger l'encodeur selon son grade
        private function redirigerSelonGrade($grade) {
            switch ($grade) {
                case 'encodeur_rh':
                    header("Location: encodeur_rh.php");
                    exit();
                case 'encodeur_conges':
                    header("Location: encodeur_CONGES.php");
                    exit();
                case 'encodeur_remuneration':
                    header("Location: encodeur_REMUN.php");
                    exit();
                case 'encodeur_poste':
                    header("Location: encodeur_POSTES.php");
                    exit();
                case 'DP':
                case 'ASG':
                    header("Location: consultationProfils.php");
                    exit();
                default:
                    echo "Grade non reconnu.";
                    exit();
            }
        }

        // Fonction principale pour gérer la connexion de l'encodeur
        public function gererConnexion($matricule, $password, $grade) {
            // Liste des grades autorisés
            $gradesAutorises = ['encodeur_rh', 'encodeur_conges', 'encodeur_remuneration', 'encodeur_poste', 'DP', 'ASG'];

            if (!in_array($grade, $gradesAutorises)) {
                return "Grade non autorisé.";
            }

            // Récupérer les informations de l'encodeur
            $sql = "SELECT id, matricule, password, grade FROM personnes WHERE matricule = :matricule AND grade = :grade";
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute(['matricule' => $matricule, 'grade' => $grade]);
            $person = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($person && $password === $person['password']) { 
                // Cas spécifique pour l'encodeur RH : redirection immédiate
                if ($grade === 'encodeur_rh') {
                    $this->redirigerSelonGrade($grade);
                }

                // Vérifier l'état de la demande de connexion
                $statusDemande = $this->verifierDemandeConnexion($person['id']);

                if ($statusDemande === 'approuvée') {
                    $this->redirigerSelonGrade($grade);
                    exit();
                } elseif ($statusDemande === 'en_attente') {
                    return "Votre demande est en attente d'approbation.";
                } elseif ($statusDemande === 'expiré' || $statusDemande === 'aucune_demande') {
                    // Insérer une nouvelle demande de connexion
                    $dateDemande = date('Y-m-d H:i:s');
                    $sqlNotification = "INSERT INTO Notifications (personne_id, status, date_demande) VALUES (:person_id, 'en_attente', :date_demande)";
                    $stmtNotification = $this->bdd->prepare($sqlNotification);
                    $stmtNotification->execute(['person_id' => $person['id'], 'date_demande' => $dateDemande]);
                    return "Votre demande est en attente d'approbation.";
                }
            } else {
                return "Informations de connexion incorrectes.";
            }
        }   
        // Fonction pour lire toutes les personnes
        public function read()
        {
            $sql = "SELECT id,Matricule, Nom, Postnom, Prenom, DateNaissance, NumTelephone, NomDivision, Remuneration, Genre,Grade FROM personnes ORDER BY id ASC";
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        // Fonction pour supprimer une personne
        public function delete($id)
        {
            $sql = 'DELETE FROM personnes WHERE id = :id';
            $stmt = $this->bdd->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        }
        // Fonction pour inserer ajouter les employés
        public function insert($matricule, $nom, $postnom, $prenom, $dateNaissance, $numTelephone, $division, $refDocEngagement, $refDocAffectation, $remuneration, $genre, $grade)
        {
            $sql = "INSERT INTO personnes (Matricule, Nom, PostNom, Prenom, DateNaissance, NumTelephone, NomDivision, Ref_acteEngagement, Ref_doc_Affectation, Remuneration, Genre, Grade)
                VALUES (:matricule, :nom, :postnom, :prenom, :dateNaissance, :numTelephone, :division, :refDocEngagement, :refDocAffectation, :remuneration, :genre, :grade)";
            $stmt = $this->bddbdd->prepare($sql);
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
