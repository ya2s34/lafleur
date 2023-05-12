<?php
include 'App/modele/M_commande.php';
include 'App/modele/M_livraison.php';
include_once 'App/modele/M_Exemplaire.php';

/**
 * Controleur pour les commandes
 */
switch ($action) {

    case 'passerCommande':

        $n = nbArticlesDuPanier();
        if ($n > 0) {
            $date = new DateTime();
            $tomorrow = $date->add(DateInterval::createFromDateString('1 day'))->format("Y-m-d");

            $idClient = $clientSess['id_client'];

            $lf_id_ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_NUMBER_INT);

            if (isset($idClient) && !empty($idClient)) {

                $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
                $date_livraison = filter_input(INPUT_POST, 'date-livraison', FILTER_SANITIZE_STRING);


                $lf_id_lotterie = M_livraison::lotterieParId();
          

                if (!empty($lf_id_lotterie)) {  
                    $lf_id_lotterie = $lf_id_lotterie[0]['id_lotterie'];
                } else {
                    echo 'erreur lotterie';
                }

                $listeArticles = M_Exemplaire::trouveLesExemplairesDuTableau($_SESSION['articles']);
         
                try {
                   $creationCOmmande=  M_Commande::creerCommande($idClient, $listeArticles, $lf_id_lotterie, $lf_id_ville, $date_livraison);
                    afficheMessage("Commande passée avec succès !");
                    echo '<a href="index.php?uc=lotterie&action=play"><div class="message">Vous avez gagné un passage à la lotterie, cliquez
                    ici !</div></a>';
                    supprimerPanier();
                } catch (PDOException $e) {
                    afficheMessage("Erreur lors de la commande");

                }
                // supprimerPanier();
                if ($creationCOmmande) {
                }
            }
        } else {
            afficheMessage("Panier vide !!");
            $uc = '';
        }
        break;
}
