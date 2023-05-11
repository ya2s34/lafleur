<section class="container_unarticle">

    <div class="tt_art">
        <h2><?= $lesArticles['nom_article'] ?></h2>
    </div>

    <div class="image_caracteristique">
        <img class=" img_article" src="../lafleur_filerouge/image/<?= $lesArticles['image'] ?>" alt="Image produits">

        <div class="caract">
            <div class="caract_titre">
                <h2>CARACTERISTIQUE</h2>
            </div>

            <table>
                <tr>
                    <th>Prix</th>
                    <th>Poids</th>
                    <th>Taille</th>
                </tr>
                <tr>
                    <td><?= $lesArticles['prix'] ?> €</td>
                    <td><?= $lesArticles['poid'] ?> g</td>
                    <td><?= $lesArticles['taille'] ?> cm</td>
                </tr>
            </table>
            <div class="btn_panier">
                <a href="index.php?uc=panier&action=ajouterAuPanier&id=<?= $lesArticles['id_article'] ?>">
                    <div class="ajt_panier">
                        AJOUTER AU PANIER
                    </div>
                </a>
            </div>

        </div>


    </div>

    <p class="desc"><?= $lesArticles['description'] ?></p>

    <?php
    include 'common/footer.php'
    ?>
</section>