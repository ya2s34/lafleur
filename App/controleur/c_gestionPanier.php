<?php
include 'App/modele/M_Exemplaire.php';
/**
 * Controleur pour la gestion du panier
 * @author Loic LOG
 */
switch ($action) {
    case 'supprimerUnArticle':
        $idArticle = filter_input(INPUT_GET, 'id');
        retirerDuPanier($idArticle);

        break;
    case 'voirPanier':
        $n = nbArticlesDuPanier();

        if ($n > 0) {

            $desIdExemplaire = getLesIdArticlesDuPanier();
            $lesArticlesDuPanier = M_Exemplaire::trouveLesExemplairesDuTableau($desIdExemplaire);
        } else {
            afficheMessage("PANIER VIDE");
            $uc = '';
        }
        break;

    case 'ajouterAuPanier':
        $lesArticlesDuPanier = [];
        $idArticle = filter_input(INPUT_GET, 'id');

        if (! ajouterAuPanier($idArticle)) {
            afficheMessage("Cet article est déjà dans le panier");
        } else {
            afficheMessage("Cet article à été ajouté");
        }
        break;
    default:
        $lesArticlesDuPanier = [];
        break;
}
