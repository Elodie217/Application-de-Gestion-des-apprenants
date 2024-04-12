<?php

namespace src\Controllers;

use src\Repositories\CoursRepository;
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
}
