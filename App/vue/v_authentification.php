<form id="connexionForm" action="index.php?uc=authentification&action=connexionClient" method="post">
    <legend class="conn">Se connecter</legend>
    <label>
        Mail<input type="mail" name="mail">
    </label>

    <label>
        Mot de passe<input type="password" name="password">
    </label>
    <button type="submit">Connectez-vous</button>
    <?php
    if (isset($_SESSION['erreur'])) {
        echo '<p>' . $_SESSION['erreur'] . '</p>';
        unset($_SESSION['erreur']);
    }
    ?>
</form>