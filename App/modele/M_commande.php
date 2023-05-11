<?php

/**
 * Requetes sur les commandes
 *
 * @author Loic LOG
 */
class M_Commande
{


    public static function creerCommande($idClient, $listeArticles, $date_livraison, $lf_id_prix_livraison, $lf_id_lotterie, $lf_id_status_livraison, $lf_id_ville)
    {
   
        $pdo = AccesDonnees::getPdo();

        // Étape 1 : Insérer les données dans la table lf_commande_client
        $stmt = $pdo->prepare("INSERT INTO lf_commande_client (date_commande, date_livraison, status_livraison, lf_id_prix_livraison, lf_id_lotterie, lf_id_client, lf_id_ville) 
VALUES (NOW(), :date_livraison, :status_livraison, :lf_id_prix_livraison, :lf_id_lotterie, :lf_id_client, :lf_id_ville)");
        $stmt->bindParam(":lf_id_client", $idClient);
        $stmt->bindParam(":lf_id_ville", $lf_id_ville);
        $stmt->bindParam(":date_livraison", $date_livraison);
        $stmt->bindParam(":lf_id_prix_livraison", $lf_id_prix_livraison);
        $stmt->bindParam(":lf_id_lotterie", $lf_id_lotterie);
        $stmt->bindParam(":status_livraison", $lf_id_status_livraison);
        $stmt->execute();

        // Récupérer l'ID de la commande créée
        $commandeId = $pdo->lastInsertId();

        // Étape 2 : Insérer les articles de la commande dans la table lf_ligne_commande_client
        foreach ($listeArticles as $article) {
            $stmt = $pdo->prepare("INSERT INTO lf_ligne_commande_client (lf_id_commande_client, lf_id_article) VALUES (:lf_id_commande_client, :lf_id_article)");
            $stmt->bindParam(":lf_id_commande_client", $commandeId);
            $stmt->bindParam(":lf_id_article", $article['id_article']);
            $stmt->execute();
        }

        // Retourner les informations de la commande
        $lesCommandes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $lesCommandes;
    }


    public static function afficherCommande($idClient)
    {
        $pdo = Accesdonnees::getPdo();
        $stmt = $pdo->prepare("SELECT exemplaires.*, commandes.*, client.*
        FROM client
        JOIN commandes ON commandes.client_id = client.id
        JOIN lignes_commande ON lignes_commande.commande_id = commandes.id
        JOIN exemplaires ON exemplaires.id = lignes_commande.exemplaire_id
     
        WHERE client.id = :clientId
        ORDER BY commandes.id DESC");
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
