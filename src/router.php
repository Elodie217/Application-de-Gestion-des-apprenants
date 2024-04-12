
<?php

use src\Controllers\HomeController;
use src\Controllers\PromoController;
use src\Controllers\TableauController;
use src\Controllers\UtilisateurController;
use src\Services\Routing;


$UtilisateurController = new UtilisateurController;


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
$routeComposee = Routing::routeComposee($route);
$HomeController = new HomeController;
$TableauController = new TableauController;
$PromoController = new PromoController;

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
                    $idUtilisateur = $_SESSION["connecté"];
                    echo $PromoController->afficherPromo($idUtilisateur);
                    die;
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
                    $idUtilisateur = $_SESSION["connecté"];
                    echo $PromoController->afficherPromo($idUtilisateur);
                    die;
                default:
                    $TableauController->indexFormateur();

                    die;
            }
        } else {
            $HomeController->index();
        }

    case HOME_URL . 'deconnexion':
        $HomeController->deconnexion();
    default:
        echo json_encode($route);
        // echo json_encode("Nothin here");
}
