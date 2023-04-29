<?php

use PhpParser\Node\Stmt;


class M_Exemplaire
{
    public static function trouveExemplaire($id)
    {
        $req = "SELECT lf_article.id_article ,lf_article.prix,lf_article.image,lf_article.categorie_id,lf_article.taille,lf_article.nom as lf_article_nom,lf_article.poid,lf_article.quantite_stock, lf_categorie.nom from lf_article JOIN lf_categorie ON lf_article.categorie_id=lf_categorie.id_categorie WHERE id_article=:id";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->bindParam(':id', $id);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function trouveTousExemplaires()
    {
        $req = "SELECT lf_article.id_article,lf_article.description ,lf_article.prix,lf_article.image,lf_article.id_categorie,lf_article.taille,lf_article.nom_article,lf_article.poid,lf_article.quantite_stock, lf_categorie.nom_categorie from lf_article JOIN lf_categorie ON lf_article.id_categorie=lf_categorie.id_categorie";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux de la
     * catégorie passée en argument
     *
     * @param $idCategorie
     * @return un tableau associatif
     */
    public static function trouveLesExemplairesDeCategorie($idCategorie)
    {
        $req = "SELECT lf_article.id_article, lf_article.prix,lf_article.description, lf_article.image, lf_article.nom_article, lf_categorie.id_categorie,lf_categorie.nom_categorie
         FROM lf_article
         LEFT JOIN lf_categorie ON lf_article.categorie_id=lf_categorie.id_categorie 
         WHERE lf_article.categorie_id = '$idCategorie'";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }


    // public static function trouveLesConsolesParExemplaire($idCat)
    // {
    //     $req = "SELECT lf_article.id AS lf_article_id,lf_article.prix,lf_article.image,lf_article.categorie_id,lf_article.etat,lf_article.nom as lf_article_nom,lf_article.console_id,lf_article.jeu_id AS id, console.nom from lf_article JOIN console ON lf_article.console_id=console.id where console_id='$idConsole' ";
    //     $res = AccesDonnees::query($req);
    //     $lesLignes = $res->fetchAll();
    //     return $lesLignes;
    // }


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
    



    // public static function trouveLesJeuxConsole($idConsole)
    // {
    //     $req = "SELECT jeu.id, jeu.prix, jeu.image,jeu.nom, lf_article.nom AS nom, console.id AS console_id,console.nom AS console_nom 
    //      FROM jeu
    //      LEFT JOIN console ON jeu.console_id=console.id 
    //      LEFT JOIN lf_article ON console.id=lf_article.console_id
    //      WHERE categorie.console_id = '$idConsole'";
    //     $res = AccesDonnees::query($req);
    //     $lesLignes = $res->fetchAll();
    //     return $lesLignes;
    // }

    public static function etiquetteVendu($lesJeux)
    {
        $vendu = [];

        foreach ($lesJeux as $value) {

            if (isset($value['lf_article_id'])) {
                $lf_article_id = $value['lf_article_id'];

                $req = "SELECT exemplaire_id as lf_article_id
                    FROM `lignes_commande` 
                    WHERE exemplaire_id =$lf_article_id";
                $res = AccesDonnees::query($req);
                $lesLignes = $res->fetch();

                $vendu[] = $lesLignes ? $lesLignes['lf_article_id'] : [];
            }
        }

        return $vendu;
    }
}
