    <section id="creationCommande">
        <form method="POST" action="index.php?uc=inscription&action=inscriptionClient">
            <fieldset>
                <legend>Inscritpion</legend>
                <p>
                    <label for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" size="30" maxlength="45">
                </p>
                <p>
                    <label for="nom">Mot de passe</label>
                    <input id="password" type="password" name="mdp" size="30" maxlength="45">
                </p>
                <p>
                    <label for="mail">Mail</label>
                    <input id="mail" type="text" name="mail" size="25" maxlength="25">
                </p>
                <p>
                    <label for="mail">Tel </label>
                    <input id="mail" type="tel" name="tel" size="25" maxlength="25">
                </p>
                <p>
                    <input type="submit" value="Valider" name="valider">
                    <input type="reset" value="Annuler" name="annuler">
                </p>
        </form>
    </section>