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
                <?php if ($client) : ?>
                    <!-- Code à exécuter si $client est vrai -->
                    <?php if ($lesArticles['quantite_stock'] < 1) : ?>
                        <div class="ajt_panier">
                            RUPTURE
                        </div>
                    <?php else : ?>
                        <a href="index.php?uc=panier&action=ajouterAuPanier&id=<?= $lesArticles['id_article'] ?>">
                            <div class="ajt_panier">
                                AJOUTER AU PANIER
                            </div>
                        </a>
                    <?php endif; ?>
                <?php else : ?>
                    <!-- Code à exécuter si $client est faux -->
                    <a href="index.php?uc=authentification">
                        <div class="card-button">
                            <svg class="svg-icon" viewBox="0 0 20 20">
                                <path d="M17.72,5.011H8.026c-0.271,0-0.49,0.219-0.49,0.489c0,0.271,0.219,0.489,0.49,0.489h8.962l-1.979,4.773H6.763L4.935,5.343C4.926,5.316,4.897,5.309,4.884,5.286c-0.011-0.024,0-0.051-0.017-0.074C4.833,5.166,4.025,4.081,2.33,3.908C2.068,3.883,1.822,4.075,1.795,4.344C1.767,4.612,1.962,4.853,2.231,4.88c1.143,0.118,1.703,0.738,1.808,0.866l1.91,5.661c0.066,0.199,0.252,0.333,0.463,0.333h8.924c0.116,0,0.22-0.053,0.308-0.128c0.027-0.023,0.042-0.048,0.063-0.076c0.026-0.034,0.063-0.058,0.08-0.099l2.384-5.75c0.062-0.151,0.046-0.323-0.045-0.458C18.036,5.092,17.883,5.011,17.72,5.011z"></path>
                                <path d="M8.251,12.386c-1.023,0-1.856,0.834-1.856,1.856s0.833,1.853,1.856,1.853c1.021,0,1.853-0.83,1.853-1.853S9.273,12.386,8.251,12.386z M8.251,15.116c-0.484,0-0.877-0.393-0.877-0.874c0-0.484,0.394-0.878,0.877-0.878c0.482,0,0.875,0.394,0.875,0.878C9.126,14.724,8.733,15.116,8.251,15.116z"></path>
                                <path d="M13.972,12.386c-1.022,0-1.855,0.834-1.855,1.856s0.833,1.853,1.855,1.853s1.854-0.83,1.854-1.853S14.994,12.386,13.972,12.386z M13.972,15.116c-0.484,0-0.878-0.393-0.878-0.874c0-0.484,0.394-0.878,0.878-0.878c0.482,0,0.875,0.394,0.875,0.878C14.847,14.724,14.454,15.116,13.972,15.116z"></path>
                            </svg>
                        </div>
                    </a>
                <?php endif; ?>

            </div>

        </div>


    </div>

    <p class="desc"><?= $lesArticles['description'] ?></p>

    <?php
    include 'common/footer.php'
    ?>
</section>