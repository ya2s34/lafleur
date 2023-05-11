<?php
include 'App/modele/M_Exemplaire.php';
include 'App/modele/M_livraison.php';


/**
 * Controleur pour la gestion du panier
 */
$lesArticlesDuPanier = [];

switch ($action) {
    case 'supprimerUnArticle':

        $idArticle = filter_input(INPUT_GET, 'id');
        retirerDuPanier($idArticle, $uc);

        break;
    case 'voirPanier':
        $n = nbArticlesDuPanier();

        $tousVilles = M_livraison::tousVilles();

        if ($n > 0) {

            $desIdExemplaire = getLesIdArticlesDuPanier();
            $lesArticlesDuPanier = M_Exemplaire::trouveLesExemplairesDuTableau($desIdExemplaire);
        } else {
            afficheMessage("PANIER VIDE");
            $uc = '';
        }
        break;

    case 'ajouterAuPanier':
        $idArticle = filter_input(INPUT_GET, 'id');

        if (! ajouterAuPanier($idArticle, $uc)) {
            afficheMessage("Cet article est déjà dans le panier");
        } else {
            afficheMessage("Cet article à été ajouté");
        }
        break;
    default:
        $lesArticlesDuPanier = [];
        break;
}
