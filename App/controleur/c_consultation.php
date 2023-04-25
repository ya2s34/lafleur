<?php
include 'App/modele/M_Exemplaire.php';


/**
 * Controleur pour la consultation des exemplaires
 * @author Loic LOG
 */
switch ($action) {
    case 'consulter':
        $lesArticles= M_Exemplaire::trouveTousExemplaires();
        $lesArticles= array_slice($lesArticles,0,4);
        break;
    // case 'voirCategories':
    //     $categorie = filter_input(INPUT_GET, 'categorie');
    //     $lesJeux = M_Exemplaire::trouveLesJeuxDeCategorie($categorie);

    //     break;

    // case 'voirCatalogue':
    //     $lesJeux = M_jeu::tousLesJeux();

    //     break;
    // case 'voirConsole':
    //     $categorie = filter_input(INPUT_GET, 'console');

    //     $lesJeux = M_Exemplaire::trouveLesConsolesParExemplaires($categorie);
    //     break;

    default:
        $lesArticles = [];
        break;
}

// $vendu = M_Exemplaire::etiquetteVendu($lesJeux);

