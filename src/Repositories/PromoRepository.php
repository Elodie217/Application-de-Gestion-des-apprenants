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
}
