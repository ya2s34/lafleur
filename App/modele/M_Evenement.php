<?php

class M_Evenement
{

    public static function trouveEvenements($idArticle)
    {
        $req = "SELECT * FROM lf_evenement
            JOIN lf_evenement_a_lf_article ON lf_evenement.id_evenement = lf_evenement_a_lf_article.lf_id_evenement
            WHERE lf_evenement_a_lf_article.lf_id_article = :id_article";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->bindParam(':id_article', $idArticle, PDO::PARAM_INT);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function trouveTousEvenements()
    {
        $req = "SELECT * FROM lf_evenement";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    public static function trouveEvenementParId($idEvenement)
    {
        $req = "SELECT * FROM lf_evenement WHERE id_evenement = :id_evenement";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->bindParam(':id_evenement', $idEvenement, PDO::PARAM_INT);
        $res->execute();
        $evenement = $res->fetch();
        return $evenement;
    }






}
