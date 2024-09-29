<?php
// Nom de la table utilisateur
$Table_Utilisateur = "utilisateur";

// Définition des tables en fonction de l'option sélectionnée
if (isset($_GET['profil'])) {
    $selectedTableTable = $_GET['profil'];
    if ($selectedTableTable == 'potager') {
        // Nom des tables pour le potager
        $Table_Alertes = "p_alertes";
        $Table_AlertesS = "p_alertes_seuils";
        $Table_Arrosage = "p_arrosage";
        $Table_ArrosageH = "p_arrosage_horaire";
        $Table_ArrosageS = "p_arrosage_seuils";
        $Table_Mesures = "p_mesures";
        $Table_ToleranceS = "p_tolerance_seuils";
    } elseif ($selectedTableTable == 'fleurs') {
        // Nom des tables pour les fleurs
        $Table_Alertes = "f_alertes";
        $Table_AlertesS = "f_alertes_seuils";
        $Table_Arrosage = "f_arrosage";
        $Table_ArrosageH = "f_arrosage_horaire";
        $Table_ArrosageS = "f_arrosage_seuils";
        $Table_Mesures = "f_mesures";
        $Table_ToleranceS = "f_tolerance_seuils";
    }
} else {
    // Par défaut, utilisez les tables pour le potager
    $Table_Alertes = "p_alertes";
    $Table_AlertesS = "p_alertes_seuils";
    $Table_Arrosage = "p_arrosage";
    $Table_ArrosageH = "p_arrosage_horaire";
    $Table_ArrosageS = "p_arrosage_seuils";
    $Table_Mesures = "p_mesures";
    $Table_ToleranceS = "p_tolerance_seuils";
}
?>
