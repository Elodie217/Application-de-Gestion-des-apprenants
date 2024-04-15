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

    public function sauvegarderPromo($nomPromo, $dateDebutPromo, $dateFinPromo, $placePromo)
    {

        if (isset($nomPromo) && !empty($nomPromo) && isset($dateDebutPromo) && !empty($dateDebutPromo) && isset($dateFinPromo) && !empty($dateFinPromo) && isset($placePromo) && !empty($placePromo)) {

            $nomPromo = htmlspecialchars($nomPromo);
            $dateDebutPromo = htmlspecialchars($dateDebutPromo);
            $dateFinPromo = htmlspecialchars($dateFinPromo);
            $placePromo = htmlspecialchars($placePromo);


            $PromoRepository = new PromoRepository;
            $reponse = $PromoRepository->sauvegarderPromo($nomPromo, $dateDebutPromo, $dateFinPromo, $placePromo);
            return json_encode($reponse);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }

    public function recupererInfoPromo($idPromo)
    {
        $PromoRepository = new PromoRepository;

        $reponse = $PromoRepository->recupererInfoPromo($idPromo);
        return json_encode($reponse);
    }

    public function editPromo($Id_promo, $nomPromoEdit, $dateDebutPromoEdit, $dateFinPromoEdit, $placePromoEdit)
    {
        if (isset($nomPromoEdit) && !empty($nomPromoEdit) && isset($dateDebutPromoEdit) && !empty($dateDebutPromoEdit) && isset($dateFinPromoEdit) && !empty($dateFinPromoEdit) && isset($placePromoEdit) && !empty($placePromoEdit)) {

            $nomPromoEdit = htmlspecialchars($nomPromoEdit);
            $dateDebutPromoEdit = htmlspecialchars($dateDebutPromoEdit);
            $dateFinPromoEdit = htmlspecialchars($dateFinPromoEdit);
            $placePromoEdit = htmlspecialchars($placePromoEdit);


            $PromoRepository = new PromoRepository;
            $reponse = $PromoRepository->editPromo($Id_promo, $nomPromoEdit, $dateDebutPromoEdit, $dateFinPromoEdit, $placePromoEdit);
            return json_encode($reponse);
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }

    public function supprPromo($Id_promo)
    {
        $PromoRepository = new PromoRepository;
        $reponse = $PromoRepository->supprPromo($Id_promo);
        return json_encode($reponse);
    }
}
