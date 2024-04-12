<?php

namespace src\Controllers;

use src\Repositories\CoursRepository;
use src\Repositories\UtilisateursCoursRepository;
use src\Services\Reponse;

class CoursController
{
    use Reponse;

    function afficherCoursPromo($idUtilisateur)
    {
        $CoursRepository = new CoursRepository;
        $reponse = $CoursRepository->CoursEtPromoByIdUtilisateurEtJour($idUtilisateur);
        return json_encode($reponse);
    }

    function recupererCodeCours($idCours)
    {
        $CoursRepository = new CoursRepository;
        $reponse = $CoursRepository->RecupererCode($idCours);
        return json_encode($reponse);
    }

    function signatureApprenant($Id_cours, $Code_cours)
    {
        if (is_numeric($Code_cours) && strlen($Code_cours) == 5) {
            $Code_cours = htmlspecialchars($Code_cours);

            $CoursRepository = new CoursRepository;
            if ($CoursRepository->signatureApprenant($Id_cours, $Code_cours)) {
                $UtilisateurCoursRepo = new UtilisateursCoursRepository;
                $IdUtilisateur = $_SESSION["connecté"];
                $reponse = $UtilisateurCoursRepo->updateAbsenceRetard($Id_cours, $IdUtilisateur);
            } else {
                $reponse = array(
                    'status' => 'error',
                    'message' => 'Code incorrecte.'
                );
            }
            return json_encode($reponse);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir un code valide.'
            );
            return json_encode($response);
        }
    }
}
