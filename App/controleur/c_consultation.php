<?php
include_once 'App/modele/M_Exemplaire.php';
include 'App/modele/M_Evenement.php';
include 'App/modele/M_Categorie.php';
include 'App/modele/M_Couleur.php';
include 'App/modele/M_lotterie.php';

$idEvenement = filter_input(INPUT_GET, 'id_evenement', FILTER_VALIDATE_INT);
$evenementSelectionne = null;

$idCouleur = filter_input(INPUT_GET, 'id_couleur', FILTER_VALIDATE_INT);
$couleurSelectionne = null;



/**
 * Controleur pour la consultation des exemplaires
 */
switch ($action) {
    case 'consulter':
        $lesArticles = M_Exemplaire::trouveTousExemplaires();
        $lesCategories = M_Categorie::trouveLesCategories();

        $lesArticles = array_slice($lesArticles, 0, 4);
        break;

    case 'filtrerEvenement':
        $idEvenement = filter_input(INPUT_GET, 'id_evenement', FILTER_SANITIZE_NUMBER_INT);
        $lesArticles = M_Exemplaire::trouveArticlesParEvenement($idEvenement, $type);
        if ($idEvenement) {
            $evenementSelectionne = M_Evenement::trouveEvenementParId($idEvenement);
        } else {
            echo '<div class="alert alert-info" role="alert">La catégorie est vide.</div>';
        }

        break;

    case 'filtrerCouleur':
        $idCouleur = filter_input(INPUT_GET, 'id_couleur', FILTER_VALIDATE_INT);
        $lesArticles = M_Exemplaire::trouveArticlesParCouleur($idCouleur, $type);
   
        if (isset($idCouleur)) {
            $couleurSelectionne = M_Couleur::trouveCouleurParId($idCouleur);
        } else {
            echo '<div class="alert alert-info" role="alert">La catégorie est vide.</div>';
        }

        break;


    case 'voirFleur':
        $lesArticles = M_Exemplaire::trouveTousExemplaires($type);
        $lesCategories = M_Categorie::trouveLesCategories();

        break;
    case 'voirArticle':
        $idArticle = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $lesArticles = M_Exemplaire::trouveArticleParId($idArticle);

        break;

    case 'play':
        $prizes = M_lotterie::getPrizes();
        

        foreach ($prizes as $prize) {
            if ($prize['lot'] == "Stylo") {
                $styloId = $prize['id_lotterie'];
                $stylo = $prize['lot'];
                $styloQty = $prize['quantite'];
            }
            if ($prize['lot'] == "Sac réutilisable tissu") {
                $sacId = $prize['id_lotterie'];
                $sac = $prize['lot'];
                $sacQty = $prize['quantite'];
            }
            if ($prize['lot'] == "porte-clef Lafleur") {
                $cleId = $prize['id_lotterie'];
                $cle = $prize['lot'];
                $cleQty = $prize['quantite'];
            }
            if ($prize['lot'] == "Rose à offrir") {
                $roseId = $prize['id_lotterie'];
                $rose = $prize['lot'];
                $roseQty = $prize['quantite'];
            }
            if ($prize['lot'] == "Bouquet à offrir") {
                $bouquetId = $prize['id_lotterie'];
                $bouquet = $prize['lot'];
                $bouquetQty = $prize['quantite'];
            }
        }

    default:
        $lesArticles = [];
        break;
}

$lesEvenements = M_Evenement::trouveTousEvenements();
$lesCouleurs = M_Couleur::trouveTousCouleurs();
$lesCategories = M_Categorie::trouveLesCategories();
