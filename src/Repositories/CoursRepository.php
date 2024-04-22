<?php

namespace src\Repositories;

use PDO;
use src\Models\Cours;
use src\Models\Database;

class CoursRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function CoursEtPromoByIdUtilisateurEtJour(int $idUtilisateur)
    {
        $time = time();
        $dateDuJour = date('Y', $time) . '-' . date('m', $time) . '-' . date('d', $time);

        $sql = "SELECT " . PREFIXE . "cours.Id_cours, " . PREFIXE . "cours.Date_cours, " . PREFIXE . "cours.HeureDebut_cours, " . PREFIXE . "cours.HeureFin_cours, " . PREFIXE . "cours.Code_cours, " . PREFIXE . "cours.Id_promo, " . PREFIXE . "promo.Nom_promo, " . PREFIXE . "promo.DateDebut_promo, " . PREFIXE . "promo.DateFin_promo, " . PREFIXE . "promo.Place_promo 
        FROM " . PREFIXE . "cours 
        INNER JOIN " . PREFIXE . "promo ON " . PREFIXE . "cours.Id_promo = " . PREFIXE . "promo.Id_promo 
        WHERE " . PREFIXE . "cours.Date_cours = :date 
        AND " . PREFIXE . "cours.Id_cours IN (SELECT Id_cours FROM " . PREFIXE . "utilisateurscours WHERE Id_utilisateur = :id)";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':id', $idUtilisateur);
        $statement->bindParam(':date', $dateDuJour);

        $statement->execute();

        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Cours::class);

        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }

        return $retour;
    }

    public function CreerCode($IdCours): int
    {
        $newCode = rand(9999, 100000);


        $sql = "UPDATE " . PREFIXE . "cours SET Code_cours =:code WHERE Id_cours = :idCours";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':code', $newCode);
        $statement->bindParam(':idCours', $IdCours);

        if ($statement->execute()) {
            return $newCode;
        }
    }

    public function RecupererCode($idCours): int
    {
        $sql = "SELECT " . PREFIXE . "cours.Code_cours FROM " . PREFIXE . "cours WHERE Id_cours = :Id_cours";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':Id_cours', $idCours);

        $statement->execute();
        $code = $statement->fetchColumn();

        if ($code == NULL) {
            $code = $this->CreerCode($idCours);
            return $code;
        } else {
            return $code;
        }
    }

    public function verificationCodeCours($idCours)
    {
        $sql = "SELECT " . PREFIXE . "cours.Code_cours FROM " . PREFIXE . "cours WHERE Id_cours = :Id_cours";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':Id_cours', $idCours);

        $statement->execute();
        $code = $statement->fetchColumn();

        if ($code !== NULL) {
            $reponse = array(
                'status' => 'signe',
            );
            return $reponse;
        } else {
            $reponse = array(
                'status' => 'aSigner',
            );

            return $reponse;
        }
    }

    public function signatureApprenant($Id_cours, $Code_cours)
    {

        $sql = "SELECT * FROM " . PREFIXE . "cours
        WHERE Id_cours = :Id_cours AND  Code_cours = :Code_cours";

        $statement = $this->db->prepare($sql);
        $statement->execute([
            ":Id_cours" => $Id_cours,
            ":Code_cours" => $Code_cours
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
