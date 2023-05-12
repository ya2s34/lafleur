<section class="container_cart">
    <div class="chemin">
        <div class="boite_detail">
            <p class="para_chemin">Panier</p>
            <div class="detail">
            </div>
        </div>
        <div class="boite_detail">
            <p class="para_chemin">Livraison</p>
            <div class="detail">
            </div>
        </div>
        <div class="boite_detail">
            <p class="para_chemin">Paiements</p>
            <div class="detail">
            </div>
        </div>
    </div>

    <h1 class="panier_title">Votre panier</h1>

    <?php
    $total = 0;

    foreach ($lesArticlesDuPanier as $unArticle) {
        $prix_article = $unArticle['prix'];
        $quantite_article = 1; // valeur par défaut
    ?>
        <div class="article_container">
            <div class="image_titre_produits">
                <img class="image_panier" src="../lafleur_filerouge/image/<?= $unArticle['image'] ?>" alt="Image produits">
                <h3><?= $unArticle['nom_article'] ?></h3>
            </div>
            <div class="prix_titre_contain">
                <div class="quantite_prix">
                    <p>Quantité</p>
                    <input type="number" name="quantite" max="<?= $unArticle['quantite_stock'] ?>" id="quantite_<?= $unArticle['id_article'] ?>" min="1" value="1" onchange="updateTotal(<?= $prix_article ?>, <?= $unArticle['id_article'] ?>)">
                </div>
                <div class="quantite_prix">
                    <p>Prix</p>
                    <p class="prix" id="prix_<?= $unArticle['id_article'] ?>"><?= $prix_article ?>€</p>
                    <a href="index.php?uc=panier&id=<?= $unArticle['id_article'] ?>&action=supprimerUnArticle" onclick="return confirm('Voulez-vous vraiment retirer ce jeu ?');">
                        <img class="img_poubelle" src="image/panier/poubelle.svg" alt="logo_supprimer">
                    </a>
                </div>
            </div>
        </div>
    <?php
        $total += $prix_article;
    }

    ?>



    <div class="contain_total">

        <div class="total_prix">
            <p>TOTAL : </p>
            <span id="prix_total"><?= $total ?></span>€<!-- affichage de la variable $total pour afficher le total des prix des articles dans le panier -->
        </div>

    </div>



    <div class="boite_btn">
        <a class="a" href="index.php?uc=visite&action=voirFleur&type=Fleurs"><input class="btn_continue" type="submit" value="Continuer mon shopping"></a>
        <a class="a" href="#poursuivre"><input class="btn_valider" type="submit" value="Poursuivre la commande"></a>
    </div>

    <div class="title_livr">
        <h1>LIVRAISON</h1>
    </div>


    <section class="contact grid__section">
        <h3 id="poursuivre" class="visibility-hidden tt_infos">ENTREZ VOS INFORMATIONS</h3>

        <div class="inscription-wrapper" id="inscription-form-link">
            <?php
            if (isset($client['id_client'])) {
                $date = new DateTime();
                $tomorrow = $date->add(DateInterval::createFromDateString('1 day'))->format("Y-m-d");
                $max = $date->add(DateInterval::createFromDateString('365 day'))->format("Y-m-d");
            ?>
                <form class="form_inscritpion" action="index.php?uc=passerCommande&action=passerCommande" method="POST">
                    <div class="input-wrapper">
                        <label for="inscription-last-adresse" class="inscription-label">Adresse
                            <span class="inscription-span"></span></label>
                        <input type="text" name="inscription-last-adresse" id="inscription-last-adresse" class="inscription-input" required>
                    </div>
                    <div class="input-wrapper">
                        <label for="inscription-first-ville" class="inscription-label">Ville
                            <span class="inscription-span"></span>
                        </label>
                        <select name="ville" id="inscription-first-ville" class="ville inscription-input" required>
                            <option value="">Sélectionnez une ville</option>
                            <?php foreach ($tousVilles as $ville) : ?>
                                <option value="<?= $ville['id_ville'] ?>"><?= $ville['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>


                    </div>

                    <div class="input-wrapper prgm_livre" id="date-livraison-wrapper">
                        <label for="date-livraison">Date de livraison</label>
                        <input class="livr" type="date" min="<?= $tomorrow ?>" max="<?= $max ?>" value="<?= $tomorrow ?>" name="date-livraison" id="date-livraison">
                    </div>


                    <div class="block-button">
                        <button type="submit" class="button">
                            VALIDER LA COMMANDE
                        </button>



                    </div>
                    <?php
                    if ($total > 50) {
                        $prixLivraison = 'Gratuit';
                    } else {
                        $prixLivraison = '2.99€';
                    }
                    ?>

                    <div class="prix_livre">
                        <p>Prix livraison : <?= $prixLivraison ?></p>
                    </div>



                </form>
            <?php
            }
            ?>

    </section>

    <?php
    include 'common/footer.php'
    ?>
</section>