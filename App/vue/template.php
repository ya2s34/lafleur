<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/LOGO_pflr.png">
    <link rel="stylesheet" href="../lafleur_filerouge/style/style.css">

    <title>Accueil</title>
</head>

<body>
    <header>
        <!-- Images En-tête -->
        <a href="index.php?page=accueil&action=consulter"><img class="logo" src="image/LOGO_pflr.png" alt="logo"></a>
        <!--  Menu haut-->
        <nav id="menu">
            <ul>
                <li><a href="index.php?page=accueil&action=consulter">ACCUEIL</a></li>
                <li><a href="index.php?page=fleurs">FLEURS</a></li>
                <li><a href="index.php?page=bouquets">BOUQUETS</a></li>
                <li><a href="index.php?uc=panier&action=voirPanier">PANIER</a></li>
                <li><a href="index.php?page=contactblog">CONTACT & BLOG</a></li>
                <?php
                $client = isset($_SESSION['client']) ? $_SESSION['client'] : false;
                if (!$client) {
                    echo "<li><a href='index.php?uc=authentification&action=connexionClient'>Connexion </a></li>";
                    echo "<li><a href = 'index.php?uc=inscription'> Inscription </a></li>";
                } else {
                    echo '<li><a href="index.php?uc=compte"> Information personelle </a></li>';
                    echo "<li><a href='index.php?uc=authentification&action=deconnexionClient'> Se déconnecter </a></li>";
                    "Vous etes connecter !";
                }
                ?>
                <div>
                    <a href=""><img class="util_icone panier" src="image/navbar/panier.svg" alt="Panier"></a>
                    <a href=""><img class="util_icone recherche" src="image/navbar/search.svg" alt="Recherche"></a>
                </div>

            </ul>
        </nav>

    </header>

    <?php
    // Controleur de vues
    // Selon le cas d'utilisation, j'inclus un controleur ou simplement une vue
    switch ($uc) {
        case 'accueil':
            include 'App/vue/v_accueil.php';
            break;
        case 'visite':
            include("App/vue/v_jeux.php");
            break;
        case 'panier':
            include("App/vue/v_panier.php");
            break;
        case 'commander':
            include("App/vue/v_commande.php");
            break;
        case 'compte':
            include("App/vue/v_compte.php");
            break;
        case 'authentification':
            include("App/vue/v_authentification.php");
            break;
        case 'inscription':
            include("App/vue/v_inscription.php");
            break;
        default:
            break;
    }
    ?>
    <!-- <div class="mousemove"></div> -->

</body>
<!-- <script src="../portfolio/style/typed.js"></script>    

<script src="../portfolio/style/main.js"></script> -->


</html>