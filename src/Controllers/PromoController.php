<?php

namespace src\Controllers;

use src\Repositories\PromoRepository;
use src\Services\Reponse;

class PromoController
{
    use Reponse;

    public function afficherPromo($idUtilisateur)
    {
        $PromoRepository = new PromoRepository;
        $reponse = $PromoRepository->promoByIdUtilisateur($idUtilisateur);
        echo json_encode($reponse);
    }
}
