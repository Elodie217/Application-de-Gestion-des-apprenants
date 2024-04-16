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
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE Email_utilisateur = :email";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $retour = $statement->fetch();

        return $retour;
    }

    public function getApprenantsbyIdPromo(int $idPromo)
    {
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE " . PREFIXE . "utilisateur.Id_role = 1 
        AND Id_utilisateur IN ( 
        SELECT " . PREFIXE . "utilisateurpromo.Id_utilisateur FROM " . PREFIXE . "utilisateurpromo 
        WHERE " . PREFIXE . "utilisateurpromo.Id_promo= :idPromo)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idPromo', $idPromo);
        $statement->execute();
        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Utilisateur::class);

        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }

        return $retour;
    }

    public function sauvegarderApprenant($nomApprenant, $prenomApprenant, $emailApprenant, $roleApprenant, $idPromo)
    {
        $sql = "INSERT INTO " . PREFIXE . "utilisateur (Nom_utilisateur, Prenom_utilisateur, Activiation_utilisateur, Email_utilisateur, Id_role) VALUES (:nomApprenant, :prenomApprenant, 1 ,:emailApprenant, :roleApprenant)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nomApprenant', $nomApprenant);
        $statement->bindParam(':prenomApprenant', $prenomApprenant);
        $statement->bindParam(':emailApprenant', $emailApprenant);
        $statement->bindParam(':roleApprenant', $roleApprenant);


        if ($statement->execute()) {

            $lastInsertedId = $this->db->lastInsertId();

            $sql = "INSERT INTO " . PREFIXE . "utilisateurpromo (Id_utilisateur, Id_promo) VALUES (:idApprenant, :idPromo)";

            $statement = $this->db->prepare($sql);
            $statement->bindParam(':idApprenant', $lastInsertedId);
            $statement->bindParam(':idPromo', $idPromo);

            if ($statement->execute()) {
                $reponse = array(
                    'status' => 'success',
                    'message' => "Nouveau apprenant enregistré !",
                    'idApprenant' => $lastInsertedId
                );
                return $reponse;
            } else {
                $reponse = array(
                    'status' => 'error',
                    'message' => "Une erreur est survenue."
                );
                return $reponse;
            }
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
            return $reponse;
        }
    }

    public function recupererApprenant($idApprenant)
    {
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE Id_utilisateur = :id";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id', $idApprenant);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Utilisateur::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

        return $retour;
    }

    public function editApprenant($Id_utilisateur, $nomApprenantEdit, $prenomApprenantEdit, $emailApprenantEdit, $compteApprenantEdit)
    {
        $sql = "UPDATE " . PREFIXE . "utilisateur SET Nom_utilisateur = :nomApprenantEdit, Prenom_utilisateur = :prenomApprenantEdit, Email_utilisateur = :emailApprenantEdit, Activiation_utilisateur = :compteApprenantEdit WHERE Id_utilisateur = :Id_utilisateur";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nomApprenantEdit', $nomApprenantEdit);
        $statement->bindParam(':prenomApprenantEdit', $prenomApprenantEdit);
        $statement->bindParam(':emailApprenantEdit', $emailApprenantEdit);
        $statement->bindParam(':compteApprenantEdit', $compteApprenantEdit);
        $statement->bindParam(':Id_utilisateur', $Id_utilisateur);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Apprenant modifiée !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }
        return $reponse;
    }

    public function supprApprenant($Id_apprenant)
    {
        $sql = "DELETE FROM " . PREFIXE . "utilisateurpromo WHERE Id_utilisateur = :Id_apprenant;
        DELETE FROM " . PREFIXE . "utilisateurcours WHERE Id_utilisateur = :Id_apprenant;
        DELETE FROM " . PREFIXE . "utilisateur WHERE Id_utilisateur = :Id_apprenant";


        $statement = $this->db->prepare($sql);

        $statement->bindParam(':Id_apprenant', $Id_apprenant);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Apprenant supprimée !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }
        return $reponse;
    }
}
