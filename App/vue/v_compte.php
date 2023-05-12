<?=
setlocale(LC_TIME, 'fr_FR.utf8','fra'); // Paramétrage de la localisation en français
?>

<h1 class="titre_page">Mon compte</h1>
<div class="info_perso">
    <h1 class="_tt">Information personelle </h1>
    <form method="POST" action="index.php?uc=compte&action=changerProfil" style="width: 60vw;">

        <p>
            Nom : <?= $client['nom'] ?>
        </p>
        <p>
            Prénom : <?= $client['prenom'] ?>
        </p>

        <p>
            Mail : <?= $client['email'] ?>
        </p>
        <p>
            Téléphone : <?= $client['telephone'] ?>
        </p>
    </form>
</div>


<div class="info_perso">
    <h1 class="_tt">Mes commandes</h1>
    <div class="flex">
        <?php foreach ($commandesClient as $commandes) {
        ?>
            <div>
                <p>Commandée le : <?= $commandes['date_commande'] ?></p>
                <p>Livraison prévue le : <?= $commandes['date_livraison'] ?></p>
                <p>Statut commande : <?= $commandes['status_livraison'] ?></p>
            </div>
            <a href="index.php?uc=article&action=voirArticle&id=<?= $commandes['id_article'] ?>">
                <div class="card">
                    <div class="card-img"> <img class=" img_card" src="../lafleur_filerouge/image/<?= $commandes['image'] ?>" alt="Image produits">
                    </div>
                    <div class="card-info">
                        <p class="text-title"><?= $commandes['nom_article'] ?> </p>
                        <p class="text-body"><?= $commandes['description'] ?></p>
                    </div>
                    <div class="card-footer">
                        <span class="text-title"><?= $commandes['prix'] ?>€</span>
                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
</div>






<!- <article style="display: flex;">