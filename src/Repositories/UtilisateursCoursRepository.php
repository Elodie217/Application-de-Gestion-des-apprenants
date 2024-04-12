<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;

class UtilisateursCoursRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function updateAbsenceRetard($IdCours, $IdUtilisateur, $Abs = 0, $Retard = 0)
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
}
