<?php

/**
 * Requetes sur les commandes
 *
 * @author Loic LOG
 */
class M_Commande
{

    public static function creerCommande($idClient, $listeArticles, $lf_id_lotterie, $lf_id_ville, $date_livraison)
    {
        $pdo = AccesDonnees::getPdo();

        // Commence une transaction
        $pdo->beginTransaction();

        try {
            // Étape 1 : Insérer les données dans la table lf_commande_client
            $stmt1 = $pdo->prepare("INSERT INTO lf_commande_client (date_commande, lf_id_lotterie, lf_id_client, lf_id_ville,date_livraison) 
        VALUES (NOW(), :lf_id_lotterie, :lf_id_client, :lf_id_ville,:date_livraison)");
            $stmt1->bindParam(":lf_id_client", $idClient);
            $stmt1->bindParam(":date_livraison", $date_livraison);
            $stmt1->bindParam(":lf_id_ville", $lf_id_ville);
            $stmt1->bindParam(":lf_id_lotterie", $lf_id_lotterie);
                $stmt1->execute();

            // Récupérer l'ID de la commande créée
            $commandeId = $pdo->lastInsertId();

            // Étape 2 : Insérer les articles de la commande dans la table lf_ligne_commande_client
            foreach ($listeArticles as $article) {
                $stmt2 = $pdo->prepare("INSERT INTO lf_ligne_commande_client (lf_id_commande_client, lf_id_article) VALUES (:lf_id_commande_client, :lf_id_article)");
                $stmt2->bindParam(":lf_id_commande_client", $commandeId);
                $stmt2->bindParam(":lf_id_article", $article['id_article']);
                // var_dump($article);die;
                $stmt2->execute();
            }

            // Si tout se passe bien, valide la transaction
            $pdo->commit();
        } catch (Exception $e) {
            // Une erreur s'est produite, annule la transaction
            $pdo->rollBack();
            throw $e;  // Lancer à nouveau l'exception pour la gérer plus haut dans la pile d'appels
        }
    }


    public static function afficherCommande($idClient)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("SELECT lf_article.*, lf_commande_client.*, lf_client.*
        FROM lf_client
        JOIN lf_commande_client ON lf_commande_client.lf_id_client = lf_client.id_client
        JOIN lf_ligne_commande_client ON lf_ligne_commande_client.lf_id_commande_client = lf_commande_client.id_commande_client
        JOIN lf_article ON lf_article.id_article = lf_ligne_commande_client.lf_id_article
     
        WHERE lf_client.id_client = :clientId
        ORDER BY lf_commande_client.lf_id_client DESC");
        $stmt->bindParam(":clientId", $idClient);
        $stmt->execute();
        $lesCommandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $lesCommandes;
    }


    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $nom : chaîne
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : chaîne
     * @param $mail : chaîne
     * @return : array
     */
    public static function estValide($nom, $rue, $ville, $cp, $mail)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ rue";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal";
        } else if (!estUnCp($cp)) {
            $erreurs[] = "erreur de code postal";
        }
        if ($mail == "") {
            $erreurs[] = "Il faut saisir le champ mail";
        } else if (!estUnMail($mail)) {
            $erreurs[] = "erreur de mail";
        }
        return $erreurs;
    }
}
