<?php

namespace src\Controllers;

use src\Repositories\PromoRepository;
use src\Services\Reponse;

class PromoController
{
    use Reponse;

    public function afficherPromoByIdUtilisateur($idUtilisateur)
    {
        $PromoRepository = new PromoRepository;
        $reponse = $PromoRepository->promoByIdUtilisateur($idUtilisateur);
        return json_encode($reponse);
    }

    public function afficherPromos()
    {
        $PromoRepository = new PromoRepository;
        $reponse = $PromoRepository->getAllPromos();
        return json_encode($reponse);
    }
}
