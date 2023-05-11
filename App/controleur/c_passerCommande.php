<?php

include 'App/modele/M_commande.php';
include 'App/modele/M_livraison.php';
include 'App/modele/M_Exemplaire.php';

/**
 * Controleur pour les commandes
 */
switch ($action) {

    case 'passerCommande':

        $n = nbArticlesDuPanier();
        if ($n > 0) {
            $idClient = $clientSess['id_client'];

            if (isset($idClient) && !empty($idClient)) {

                $adresse = filter_input(INPUT_POST, 'inscription-last-adresse', FILTER_SANITIZE_STRING);
                $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
                $codePostal = filter_input(INPUT_POST, 'inscription-post', FILTER_SANITIZE_STRING);
                // $dateLivraison = filter_input(INPUT_POST, 'date-livraison', FILTER_SANITIZE_STRING);
                $date_livraison = filter_input(INPUT_POST, 'livraison', FILTER_SANITIZE_STRING);

                // Vous devez récupérer l'ID de la ville à partir du nom de la ville

                $lf_id_prix_livraison = M_livraison::toutPrixLivraison();
                $lf_id_prix_livraison = $lf_id_prix_livraison[0]['id_prix_livraison'];

                $lf_id_lotterie = M_livraison::lotterieParId();
                $lf_id_lotterie = $lf_id_lotterie[0]['id_lotterie'];
                $lf_id_status_livraison = 2;
                $listeArticles = M_Exemplaire::trouveLesExemplairesDuTableau($_SESSION['articles']);


                try {
                    M_Commande::creerCommande($idClient, $listeArticles, $date_livraison, $lf_id_prix_livraison, $lf_id_lotterie, $lf_id_status_livraison, $ville);
                    afficheMessage("Commande passée avec succès !");
                    echo '<a href="index.php?uc=lotterie&action=play"><div class="btn_lotterie">Vous avez gagné un passage à la lotterie, cliquez ici !</div></a>';
                    supprimerPanier();
                } catch (PDOException $e) {
                    echo 'erreur lors de la commande';
                }
            }
        } else {
            afficheMessage("Panier vide !!");
            $uc = '';
        }
        break;
}
