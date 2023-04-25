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
    foreach ($lesArticlesDuPanier as $unArticle) {
    ?>
        <div class="article_container">

            <div class="image_titre_produits">
                <img class="image_panier" src="images_fleurs/fleurs/<?= $unArticle['image'] ?>" alt="image produit">
                <h3><?= $unArticle['nom_article'] ?></h3>
            </div>
            <div class="prix_titre_contain">

                <div class="quantite_prix">
                    <p>
                        Quantité
                    </p>
                    <input type="number" name="quantite" min="1" value="1">
                </div>
                <div class="quantite_prix">
                    <p>
                        Prix
                    </p>
                    <p class="prix"><?= $unArticle['prix'] ?></p>
                    <a href="index.php?uc=panier&article=<?= $unArticle['id_article'] ?>&action=supprimerUnArticle" onclick="return confirm('Voulez-vous vraiment retirer ce jeu ?');"><img class="img_poubelle" src="image/panier/poubelle.svg" alt="logo_supprimer"></a>
                </div>
            </div>

        </div>
    <?php
    }
    ?>

    <div class="contain_total">

        <div class="total_prix">
            <p>TOTAL : </p>
            <p><?= $unArticle['prix'] ?></p>
        </div>

    </div>


    <div class="boite_btn">
        <a href=""><input class="btn_continue" type="submit" value="Continuer mon shopping"></a>
        <a href=""><input class="btn_valider" type="submit" value="Poursuivre la commande"></a>
    </div>

</section>