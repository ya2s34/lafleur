<?php

class M_livraison
{

    public static function toutPrixLivraison()
    {
        $req = "SELECT id_prix_livraison FROM lf_prix_livraison WHERE prix = 2.99";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function toutStatusLivraison()
    {
        $req = "SELECT * FROM lf_status_livraison";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function lotterie()
    {
        $req = "SELECT * FROM lf_lotterie";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function lotterieParId()
    {
        $req = "SELECT id_lotterie FROM lf_lotterie";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function tousVilles()
    {
        $req = "SELECT * FROM lf_ville";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    public static function getVilleIdByName($villeName)
    {
        $req = "SELECT id_ville FROM lf_ville WHERE nom = :nom_ville";
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->bindParam(":nom_ville", $villeName);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id_ville'];
    }
}
