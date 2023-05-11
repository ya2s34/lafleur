<?php

class M_Couleur
{


    public static function trouveCouleurParId($idCouleur)
    {
        $req = "SELECT * FROM lf_couleur WHERE id_couleur = :id_couleur";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->prepare($req);
        $res->bindParam(':id_couleur', $idCouleur, PDO::PARAM_INT);
        $res->execute();
        $couleur = $res->fetch();
        return $couleur;
    }

    public static function trouveTousCouleurs()
    {
        $req = "SELECT * FROM lf_couleur";
        $pdo = AccesDonnees::getPdo();
        $res = $pdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }







}
