<?php
require_once 'traitement.php'; // Inclure la classe traitement

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $Matricule = $_POST['Matricule'];
    $Date_Enregistrement = $_POST['Date_Enregistrement'];
    $DateDebut = $_POST['DateDebut'];
    $DateFin = $_POST['DateFin'];
    $TypeConge = $_POST['TypeConge'];

    // Création d'une instance de la classe Conge
    $conge = new traitement();

    // Appel de la méthode pour ajouter un congé
    $result = $conge->ajouter_conge($Matricule,$Date_Enregistrement, $DateDebut, $DateFin, $TypeConge);

    // Vérification du résultat et redirection ou affichage du message
    if ($result) {
        echo "Congé ajouté avec succès.";
        // Redirection vers une autre page si nécessaire
        header("Location: conges.php");
    } else {
        echo "Erreur lors de l'ajout du congé.";
    }
}
?>
