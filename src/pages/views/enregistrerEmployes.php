<?php
require_once('traitement.php');

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
$refDocAffectation = $_POST['ref_affectation'];
$refDocEngagement = $_POST['ref_engagement'];

$traitement = new traitement();

$result = $traitement->insert($matricule, $nom, $postnom, $prenom, $dateNaissance, $numTelephone, $division, $refDocEngagement, $refDocAffectation, $remuneration, $genre, $grade);
header("Location: ajouter_Modifier_Employes_RH.php");
