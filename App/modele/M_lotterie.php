<?php


class M_Lotterie
{
    public static function getPrizes()
    {
        $req = "SELECT lf_lotterie.lot, lf_lotterie.quantite, lf_lotterie.id_lotterie FROM lf_lotterie
                    WHERE lf_lotterie.quantite > -1";
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
