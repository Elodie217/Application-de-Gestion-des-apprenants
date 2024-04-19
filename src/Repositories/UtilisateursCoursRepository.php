<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;
use src\Models\Utilisateur;
use src\Models\UtilisateursCours;

class UtilisateursCoursRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function updateAbsenceRetard($IdCours, $IdUtilisateur, $Retard = 0, $Abs = 0)
    {
        $sql = "UPDATE " . PREFIXE . "utilisateurscours SET Absence_UtilisateursCours =:abs, Retard_UtilisateursCours = :retard WHERE Id_cours = :idCours AND Id_utilisateur = :idUtilisateur";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idUtilisateur', $IdUtilisateur);
        $statement->bindParam(':idCours', $IdCours);
        $statement->bindParam(':abs', $Abs);
        $statement->bindParam(':retard', $Retard);


        if ($statement->execute()) {
            $reponse = array(
                'status' => 'success',
            );
        } else {
            $reponse = array(
                'status' => 'error',
            );
        }

        return $reponse;
    }

    public function verifiactionSignature($idCours)
    {
        $idUtilisateur = $_SESSION['connecté'];

        $sql = "SELECT * FROM " . PREFIXE . "utilisateurscours WHERE Id_cours = :Id_cours AND Id_utilisateur = :Id_utilisateur";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':Id_cours', $idCours);
        $statement->bindParam(':Id_utilisateur', $idUtilisateur);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, UtilisateursCours::class);
        $objet = $statement->fetch();

        if ($objet->getAbsenceUtilisateursCours() !== NULL && $objet->getRetardUtilisateursCours() !== NULL) {
            $reponse = array(
                'status' => 'signe',
            );
        } else {
            $reponse = array(
                'status' => 'aSigner',
            );
        }

        return $reponse;
    }

    public function recupererRetards($Id_promo)
    {
        $sql = "SELECT * FROM " . PREFIXE . "utilisateur WHERE Id_utilisateur IN (
	SELECT " . PREFIXE . "utilisateurscours.Id_utilisateur FROM " . PREFIXE . "utilisateurscours WHERE Retard_UtilisateursCours = 1
    ) AND Id_utilisateur IN (
	SELECT " . PREFIXE . "utilisateurpromo.Id_utilisateur FROM " . PREFIXE . "utilisateurpromo WHERE " . PREFIXE . "utilisateurpromo.Id_promo = :idPromo
    )";

        $statement = $this->db->prepare($sql);
        $statement->bindParam(':idPromo', $Id_promo);
        $statement->execute();
        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Utilisateur::class);

        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }
        return $retour;
    }
}
