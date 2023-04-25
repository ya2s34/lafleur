<?php

class AccesDonnees
{

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=lf_lafleur_back';
    private static $user = 'root';
    private static $mdp = '';

    /**
     *
     * @var PDO
     */
    private static $monPdo;

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * retourne l'unique objet de la classe
     * @return PDO
     */
    public static function getPdo()
    {
        if (AccesDonnees::$monPdo == null) {
            AccesDonnees::$monPdo = new PDO(AccesDonnees::$serveur . ';' . AccesDonnees::$bdd, AccesDonnees::$user, AccesDonnees::$mdp);
            AccesDonnees::$monPdo->query("SET CHARACTER SET utf8");
        }
        return AccesDonnees::$monPdo;
    }

    /**
     * Exécution d'une requete de lecture
     * @param string $requete_sql
     * @return PDOStatement
     */
    public static function query(string $requete_sql)
    {
        return AccesDonnees::getPdo()->query($requete_sql);
    }

    /**
     * Execution d'une requete d'écriture
     * @param string $requete_sql
     * @return int
     */
    public static function exec(string $requete_sql)
    {
        return AccesDonnees::getPdo()->exec($requete_sql);
    }
}
