
<?php

use src\Controllers\CoursController;
use src\Controllers\HomeController;
use src\Controllers\PromoController;
use src\Controllers\RoleController;
use src\Controllers\TableauController;
use src\Controllers\UtilisateurController;
use src\Services\Routing;




// $route est la route dans l'url, ex: http://localhost/ga/public/fims/123
$route = $_SERVER['REQUEST_URI'];

// $methode est la méthode http la requête qui accède au serveur 
// Elle se définis en javascript quand on fais un appel réseau 
// Exemple  de méthode : "GET" , "POST", "PUT", "PATCH" etc.... 
// Rappel, pour la définir en front, cela se fait dans le js 

$methode = $_SERVER['REQUEST_METHOD'];



// $routecomposee décompose tous les paramètres d'url après l'url du serveur
// Par exemple , si mon url est  http://localhost/ga/public/films/delete/1
// $routeComposée sera un tableau contenant les paramètres après public entrecoupée par des / 
// donc ["film","delete","1"]
$UtilisateurController = new UtilisateurController;
$routeComposee = Routing::routeComposee($route);
$HomeController = new HomeController;
$TableauController = new TableauController;
$PromoController = new PromoController;
$CoursController = new CoursController;
$RoleController = new RoleController;

// j'utilise la boucle switch , pour gérer toutes les routes possibles dans mon application.
// c'est à dire que chaque partie accessible aura son propre case 
// Si j'ai une route login , il y a aura un case "login" etc...
switch ($route) {
    case HOME_URL:
        if (isset($_SESSION['connecté'])) {
            header('location: ' . HOME_URL . 'tableaudebord');
            die;
        } else {
            $HomeController->index();
        }
        break;

    case HOME_URL . 'connexion':

        $data = file_get_contents("php://input");

        $user = json_decode($data, true);

        $email = htmlspecialchars(strip_tags(trim($user["emailConnexion"])));
        $password = htmlspecialchars(strip_tags(trim($user["motDePasseConnexion"])));

        $reponse =   $UtilisateurController->connexion($email, $password);

        echo json_encode($reponse);

        break;
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
                        default:
                            echo $PromoController->afficherPromos();
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
