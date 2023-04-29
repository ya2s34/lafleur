<?php

class M_utilisateur
{


    public static function createUser($nom, $email, $tel, $password)
    {
        if ($erreurs = static::estValide($nom, $email, $tel, $password)) {
            return $erreurs;
        };
        $pdo = AccesDonnees::getPdo();
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('INSERT INTO lf_client(nom, email, telephone, mot_de_passe,cree_a) VALUES (:nom, :email, :tel, :password,NOW())');
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }


    public static function trouverClientParId($idClient)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM lf_client WHERE id_client = :id");
        $stmt->bindParam(":id", $idClient);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        return $client;
    }





    public static function findUserMail($email, $password)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM lf_client WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($client && password_verify($password, $client["mot_de_passe"])) {
            return $client;
        }
        return false;
    }

    public static function estValide($nom, $email, $tel, $password)
    {
        $erreurs = [];
        if ($nom == "") {
            $erreurs[] = "Il faut saisir le champ nom";
        }
        if ($email == "") {
            $erreurs[] = "Il faut saisir le champ mail";
        }

        if ($tel == "") {
            $erreurs[] = "Il faut saisir le champ Code téléphone";
            if (!estUnMail($email)) {
                $erreurs[] = "erreur de mail";
            }
            return $erreurs;
        }
    }
}
