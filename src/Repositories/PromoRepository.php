<?php

namespace src\Repositories;


use PDO;
use src\Models\Database;
use src\Models\Promo;

class PromoRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function promoByIdUtilisateur(int $idUtilisateur)
    {
        $sql = "SELECT * FROM " . PREFIXE . "promo WHERE " . PREFIXE . "promo.Id_promo IN (
        SELECT " . PREFIXE . "utilisateurpromo.Id_promo FROM " . PREFIXE . "utilisateurpromo WHERE " . PREFIXE . "utilisateurpromo.Id_utilisateur = :id)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id', $idUtilisateur);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, Promo::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

        return $retour;
    }

    public function getAllPromos()
    {

        $sql = "SELECT * FROM " . PREFIXE . "promo";

        $statement = $this->db->prepare($sql);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Promo::class);
        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }

    public function sauvegarderPromo($nomPromo, $dateDebutPromo, $dateFinPromo, $placePromo)
    {
        $sql = "INSERT INTO " . PREFIXE . "promo (Nom_promo, DateDebut_promo, DateFin_promo, Place_promo) VALUES (:nomPromo, :dateDebutPromo, :dateFinPromo, :placePromo)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nomPromo', $nomPromo);
        $statement->bindParam(':dateDebutPromo', $dateDebutPromo);
        $statement->bindParam(':dateFinPromo', $dateFinPromo);
        $statement->bindParam(':placePromo', $placePromo);


        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Nouvelle promotion enregistrée !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }

        return $reponse;
    }

    public function recupererInfoPromo($idPromo)
    {
        $sql = "SELECT * FROM " . PREFIXE . "promo WHERE " . PREFIXE . "promo.Id_promo = :id";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id', $idPromo);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, Promo::class);
        $objet = $statement->fetch();

        $retour = $objet->getObjectToArray();

        return $retour;
    }

    public function editPromo($idPromo, $nomPromoEdit, $dateDebutPromoEdit, $dateFinPromoEdit, $placePromoEdit)
    {
        $sql = "UPDATE " . PREFIXE . "promo SET Nom_promo = :nomPromoEdit, DateDebut_promo = :dateDebutPromoEdit, DateFin_promo = :dateFinPromoEdit, Place_promo = :placePromoEdit WHERE Id_promo = :idPromo";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':nomPromoEdit', $nomPromoEdit);
        $statement->bindParam(':dateDebutPromoEdit', $dateDebutPromoEdit);
        $statement->bindParam(':dateFinPromoEdit', $dateFinPromoEdit);
        $statement->bindParam(':placePromoEdit', $placePromoEdit);
        $statement->bindParam(':idPromo', $idPromo);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Promotion modifiée !"
            );
        } else {
            $reponse = array(
                'status' => 'error',
                'message' => "Une erreur est survenue."
            );
        }
        return $reponse;
    }

    public function supprPromo($Id_promo)
    {
        $sql = "DELETE FROM " . PREFIXE . "promo WHERE Id_promo = :Id_promo";


        $statement = $this->db->prepare($sql);

        $statement->bindParam(':Id_promo', $Id_promo);

        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
                'message' => "Promotion supprimée !"
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
