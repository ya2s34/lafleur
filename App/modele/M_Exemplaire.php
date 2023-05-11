<?php

use PhpParser\Node\Stmt;


class M_Exemplaire
{

    public static function trouveTousExemplaires($nomCategorie = null)
    {
        $req = "SELECT lf_article.id_article,lf_article.description ,lf_article.prix,lf_article.image,lf_article.id_categorie,lf_article.taille,lf_article.nom_article,lf_article.poid,lf_article.quantite_stock, lf_categorie.nom_categorie 
        from lf_article 
        JOIN lf_categorie 
        ON lf_article.id_categorie=lf_categorie.id_categorie";
        $pdo = AccesDonnees::getPdo();
        if (isset($nomCategorie)) {
            $req .= " WHERE lf_categorie.nom_categorie=:nomCategorie";
            $res = $pdo->prepare($req);
            $res->bindParam(":nomCategorie", $nomCategorie, PDO::PARAM_STR);
        } else {
            $res = $pdo->prepare($req);
        }
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    public static function trouveArticleParId($idArticle)
    {
        $req = "SELECT *
            FROM lf_article
            WHERE lf_article.id_article = :idArticle";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->bindParam(":idArticle", $idArticle, PDO::PARAM_INT);
        $res->execute();
        $article = $res->fetch();
        return $article;
    }


    public static function trouveArticlesParEvenement($idEvenement, $nomCategorie)
    {

        $req = "SELECT * FROM lf_article
        JOIN lf_evenement_a_lf_article ON lf_article.id_article = lf_evenement_a_lf_article.lf_id_article
        JOIN lf_categorie ON lf_article.id_categorie = lf_categorie.id_categorie
        WHERE lf_evenement_a_lf_article.lf_id_evenement = :id_evenement AND lf_categorie.nom_categorie = :nomCategorie";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->bindParam(':id_evenement', $idEvenement, PDO::PARAM_INT);
        $res->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }


    public static function trouveArticlesParCouleur($idCouleur, $nomCategorie)
    {
        $pdo = AccesDonnees::getPdo();
        $req = "SELECT * FROM lf_article
        JOIN lf_couleur ON lf_article.id_couleur = lf_couleur.id_couleur
        JOIN lf_categorie ON lf_article.id_categorie = lf_categorie.id_categorie
        WHERE lf_couleur.id_couleur = :id_couleur AND lf_categorie.nom_categorie = :nomCategorie";
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(':id_couleur', $idCouleur, PDO::PARAM_INT);
        $stmt->bindParam(':nomCategorie', $nomCategorie, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetchAll();
        return $resultat;
    }


    /**
     * Retourne les jeux concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdExemplaires tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesExemplairesDuTableau($desIdExemplaires)
    {
        $nbProduits = count($desIdExemplaires);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdExemplaires as $unIdProduit) {
                $req = "SELECT * FROM lf_article WHERE id_article =:unIdProduit";
                $pdo = AccesDonnees::getPdo();
                $stmt = $pdo->prepare($req);
                $stmt->bindParam(':unIdProduit', $unIdProduit, PDO::PARAM_INT);
                $stmt->execute();
                $unProduit = $stmt->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }



    // public static function etiquetteVendu($lesJeux)
    // {
    //     $vendu = [];

    //     foreach ($lesJeux as $value) {

    //         if (isset($value['lf_article_id'])) {
    //             $lf_article_id = $value['lf_article_id'];

    //             $req = "SELECT exemplaire_id as lf_article_id
    //                 FROM `lignes_commande` 
    //                 WHERE exemplaire_id =$lf_article_id";
    //             $res = AccesDonnees::query($req);
    //             $lesLignes = $res->fetch();

    //             $vendu[] = $lesLignes ? $lesLignes['lf_article_id'] : [];
    //         }
    //     }

    //     return $vendu;
    // }
}
