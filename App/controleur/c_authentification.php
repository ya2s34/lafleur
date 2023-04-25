<?php

include 'App/modele/M_Utilisateur.php';


switch ($action) {

    case 'connexionClient':
        $email = filter_input(INPUT_POST, 'mail');
        $password = filter_input(INPUT_POST, 'password');
        $client = M_utilisateur::findUserMail($email, $password);


        if ($client) {
            $_SESSION['client'] = $client;
            echo 'Vous etes connectez !!';
            header('Location: index.php');  
        }
        break;

    case 'deconnexionClient':
        supprimerPanier();
        unset($_SESSION['client']);
        header('Location: index.php');
        die();
        break;

    case 'inscriptionClient':
        $email = filter_input(INPUT_POST, 'mail');
        $password = filter_input(INPUT_POST, 'mdp');
        $nom = filter_input(INPUT_POST, 'nom');
        $tel = filter_input(INPUT_POST, 'tel');
        header('Location: index.php');
        $client = M_utilisateur::createUser($nom, $email, $tel, $password);
        break;
}
