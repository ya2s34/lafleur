    <section id="creationCommande">
        <form method="POST" action="index.php?uc=inscription&action=inscriptionClient">
            <fieldset>
                <legend>Inscription</legend>
                <p>
                    <label for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" size="30" maxlength="45" required>
                </p>
                <p>
                    <label for="prenom">Prénom</label>
                    <input id="prenom" type="text" name="prenom" size="30" maxlength="45" required>
                </p>
                <p>
                    <label for="nom">Mot de passe</label>
                    <input id="password" type="password" name="mdp" size="30" maxlength="45" required>
                </p>
                <p>
                    <label for="mail">Mail</label>
                    <input id="mail" type="text" name="mail" size="25" maxlength="25" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                </p>
                <p>
                    <label for="mail">Téléphone </label>
                    <input id="mail" type="tel" name="tel" size="25" maxlength="25" required pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$">
                </p>
                <p>
                    <input type="submit" value="Valider" name="valider">
                    <input type="reset" value="Annuler" name="annuler">
                </p>
        </form>
    </section>