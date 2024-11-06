<?php
// Assurez-vous de gérer les sessions et les autorisations si nécessaire
include ('traitement.php');

// Vérifiez si l'ID de l'employé est passé via l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $traitement = new traitement();

    // Suppression de l'employé
    $result = $traitement->delete($id);

    if ($result) {
        // Rediriger ou afficher un message de succès
        header("Location: ajouter_Modifier_Employes_RH.php?msg=Suppression reussie!");
        exit();
    } else {
        // Gérer les erreurs
        echo 'Erreur lors de la suppression de l\'employé';
        exit();
    }
} else {
    // Gérer les erreurs si l'ID n'est pas valide
    echo 'ID de l\'employé invalide';
    exit();
}
?>
