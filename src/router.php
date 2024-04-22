
<?php

use src\Controllers\CoursController;
use src\Controllers\HomeController;
use src\Controllers\PromoController;
use src\Controllers\RoleController;
use src\Controllers\TableauController;
use src\Controllers\UtilisateurController;
use src\Services\Routing;




$route = $_SERVER['REQUEST_URI'];


$methode = $_SERVER['REQUEST_METHOD'];


$UtilisateurController = new UtilisateurController;
$routeComposee = Routing::routeComposee($route);
$HomeController = new HomeController;
$TableauController = new TableauController;
$PromoController = new PromoController;
$CoursController = new CoursController;
$RoleController = new RoleController;


switch ($route) {
    case HOME_URL:
        if (isset($_SESSION['connecté'])) {
            header('location: ' . HOME_URL . 'tableaudebord');
            die;
        } else {
            $HomeController->index();
            die;
        }

    case HOME_URL . 'connexion':

        $data = file_get_contents("php://input");

        $user = json_decode($data, true);

        $email = htmlspecialchars(strip_tags(trim($user["emailConnexion"])));
        $password = htmlspecialchars(strip_tags(trim($user["motDePasseConnexion"])));

        $reponse =   $UtilisateurController->connexion($email, $password);

        echo json_encode($reponse);

        die;

    case $routeComposee[0] == 'sinscrire':

        switch ($route) {
            case $routeComposee[1] == "inscription":

                $data = file_get_contents("php://input");

                $user = json_decode($data, true);

                $mdpInscription = htmlspecialchars(strip_tags(trim($user["mdpInscription"])));
                $mdpConfirmation = htmlspecialchars(strip_tags(trim($user["mdpConfirmation"])));
                $idUSer = $user["fin_url"];

                $reponse = $UtilisateurController->inscription($mdpInscription, $mdpConfirmation, $idUSer);

                echo $reponse;

                die;

            default:
                $HomeController->pageInscription();

                die;
        }


    case HOME_URL . 'tableaudebord':
        if (isset($_SESSION["connecté"]) && $_SESSION['role'] == 1) {
            header('location: ' . HOME_URL . 'tableaudebordApprenant');
        } else if (isset($_SESSION["connecté"]) && $_SESSION['role'] == 2) {
            header('location: ' . HOME_URL . 'tableaudebordFormateur');
        }

    case $routeComposee[0] == "tableaudebordApprenant":
        if (isset($_SESSION["connecté"]) && $_SESSION['role'] == 1) {

            switch ($route) {
                case $routeComposee[1] == "accueil":

                    switch ($route) {
                        case $routeComposee[2] == "code":
                            $data = file_get_contents("php://input");

                            $Cours = json_decode($data, true);

                            echo $CoursController->signatureApprenant($Cours['Id_cours'], $Cours['Code_cours']);
                            die;

                        case $routeComposee[2] == "codeRetard":
                            $data = file_get_contents("php://input");

                            $Cours = json_decode($data, true);

                            echo $CoursController->signatureApprenant($Cours['Id_cours'], $Cours['Code_cours'], 1);
                            die;


                        case $routeComposee[2] == "verifsignature":
                            $data = file_get_contents("php://input");

                            $Cours = json_decode($data, true);

                            echo $CoursController->verifiactionSignature($Cours['Id_cours']);
                            die;

                        default:
                            $idUtilisateur = $_SESSION["connecté"];

                            echo $CoursController->afficherCoursPromo($idUtilisateur);
                            die;
                    }

                default:
                    $TableauController->indexApprenant();
                    die;
            }
        } else {
            $HomeController->index();
        }
    case $routeComposee[0] == "tableaudebordFormateur":
        if (isset($_SESSION["connecté"]) && $_SESSION['role'] == 2) {

            switch ($route) {
                case $routeComposee[1] == "accueil":
                    switch ($route) {
                        case $routeComposee[2] == "code":
                            $data = file_get_contents("php://input");

                            $Cours = json_decode($data, true);

                            echo $CoursController->recupererCodeCours($Cours['Id_cours']);
                            die;

                        case $routeComposee[2] == "verifcodecreer":
                            $data = file_get_contents("php://input");

                            $Cours = json_decode($data, true);

                            echo $CoursController->verificationCodeCours($Cours['Id_cours']);
                            die;
                        default:
                            $idUtilisateur = $_SESSION["connecté"];

                            echo $CoursController->afficherCoursPromo($idUtilisateur);
                            die;
                    }
                case $routeComposee[1] == "promotions":
                    switch ($route) {
                        case $routeComposee[2] == "apprenants":
                            $data = file_get_contents("php://input");

                            $Promo = json_decode($data, true);

                            echo $UtilisateurController->ApprenantsByIdPromo($Promo['Id_promo']);
                            die;
                        case $routeComposee[2] == "roles":
                            echo $RoleController->recupererRoles();
                            die;
                        case $routeComposee[2] == "newpromo":
                            $data = file_get_contents("php://input");

                            $Promo = json_decode($data, true);

                            echo $PromoController->sauvegarderPromo($Promo['nomPromo'], $Promo['dateDebutPromo'], $Promo['dateFinPromo'], $Promo['placePromo']);
                            die;
                        case $routeComposee[2] == "affichereditpromo":
                            $data = file_get_contents("php://input");

                            $Promo = json_decode($data, true);

                            echo $PromoController->recupererInfoPromo($Promo["idPromo"]);
                            die;
                        case $routeComposee[2] == "editpromo":
                            $data = file_get_contents("php://input");

                            $Promo = json_decode($data, true);

                            echo $PromoController->editPromo($Promo["Id_promo"], $Promo["nomPromoEdit"], $Promo["dateDebutPromoEdit"], $Promo["dateFinPromoEdit"], $Promo["placePromoEdit"]);
                            die;
                        case $routeComposee[2] == "supprpromo":
                            $data = file_get_contents("php://input");

                            $Promo = json_decode($data, true);

                            echo $PromoController->supprPromo($Promo["Id_promo"]);
                            die;
                        default:
                            echo $PromoController->afficherPromos();
                            die;
                    }

                case $routeComposee[1] == "apprenants":
                    switch ($route) {
                        case $routeComposee[2] == "newapprenant":
                            $data = file_get_contents("php://input");

                            $Apprenant = json_decode($data, true);

                            echo $UtilisateurController->creerApprenant($Apprenant['nomApprenant'], $Apprenant['prenomApprenant'], $Apprenant['emailApprenant'], $Apprenant['roleApprenant'], $Apprenant['idPromo']);
                            die;
                        case $routeComposee[2] == "affichereditapprenant":
                            $data = file_get_contents("php://input");

                            $Apprenant = json_decode($data, true);
                            echo $UtilisateurController->recupererApprenant($Apprenant['idApprenant']);
                            die;
                        case $routeComposee[2] == "editapprenant":
                            $data = file_get_contents("php://input");

                            $Apprenant = json_decode($data, true);

                            echo $UtilisateurController->editApprenant($Apprenant['Id_utilisateur'], $Apprenant['nomApprenantEdit'], $Apprenant['prenomApprenantEdit'], $Apprenant['emailApprenantEdit'], $Apprenant['compteApprenantEdit']);
                            die;
                        case $routeComposee[2] == "supprappr":
                            $data = file_get_contents("php://input");

                            $Apprenant = json_decode($data, true);

                            echo $UtilisateurController->supprApprenant($Apprenant['Id_apprenant']);
                            die;
                        default:
                            //Là faudrait mettre la où on affiche tous les apprenants
                    }
                case $routeComposee[1] == "retards":
                    switch ($route) {
                        case $routeComposee[2] == "apprenants":
                            // $data = file_get_contents("php://input");

                            // $Promo = json_decode($data, true);

                            // echo $UtilisateurController->ApprenantsByIdPromo($Promo['Id_promo']);
                            die;

                        default:
                            $data = file_get_contents("php://input");

                            $Promo = json_decode($data, true);

                            echo $UtilisateurController->recupererRetards($Promo['Id_promo']);

                            die;
                    }
                default:
                    $TableauController->indexFormateur();

                    die;
            }
        } else {
            $HomeController->index();
            die;
        }

    case HOME_URL . 'deconnexion':
        $HomeController->deconnexion();
        echo true;
        die;
    default:
        echo json_encode("Nothin here");
}
