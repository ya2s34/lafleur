<?php

class M_Categorie
{

    /**
     * Retourne toutes les catégories sous forme d'un tableau associatif
     *
     * @return le tableau associatif des catégories
     */
    public static function trouveLesCategories()
    {
        $req = "SELECT * FROM lf_categorie";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    // public static function supprimerUneCategorie()
    // {
    //     $req = "SELECT vendu FROM categories WHERE";
    //     $res = AccesDonnees::query($req);
    //     $lesLignes = $res->fetchAll();
    //     return $lesLignes;
    // }



}
