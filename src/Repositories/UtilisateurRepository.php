<?php

namespace src\Repositories;

use src\Models\Database;
use src\Models\Utilisateur;
use PDO;

class UtilisateurRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }


    public function connexion(string $email, string $motDePasse)
    {
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE Email_utilisateur = :email";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $utilisateur = $statement->fetch();

        if ($utilisateur) {
            if (password_verify($motDePasse, $utilisateur->getMotDePasseUtilisateur())) {
                return $statement->rowCount() == 1;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUtilisateurbyEmail(string $email): Utilisateur|bool
    {
        $sql = "SELECT * FROM " . PREFIXE . " utilisateur WHERE Email_utilisateur = :email";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $retour = $statement->fetch();

        return $retour;
    }
}
