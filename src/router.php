
<?php

use src\Controllers\HomeController;
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

        // Dans le cas ou la route est à l'accueil, mais on pourrait définir une autre route
    case HOME_URL . 'connexion':

        // Je récupère la date
        $data = file_get_contents("php://input");

        // Cette data étant envoyée en JSON, je dois la decoder avec cette fonction
        // pour que ça soit interprétable par php
        // le second argument true, indique que le résultat
        // doit être sous forme de tableau 
        // Pourquoi ? parce que ca sera plus facilement gérable en php
        $user = json_decode($data, true);

        // Je déclare la variable email -> qui a une version néttoyée et sécurisée
        // de ce qu'il y a dans mon tableau user à son index email, 
        // voila pourquoi on passait l'argument true à la fonction
        // json_decode()
        $email = htmlspecialchars(strip_tags(trim($user["emailConnexion"])));
        $password = htmlspecialchars(strip_tags(trim($user["motDePasseConnexion"])));

        //  Maintenant que nous avons récupérer l'email et le password
        // Nous allons pouvoir les donner à notre userController 
        // et plus particulièrement à sa fonction login 
        // auquel je fais appel ici
        // Je fais appel à cette fonction en la mettant dans la variable
        // reponse
        // pourquoi ? car je pourrais retourner au format json cette réponse
        // L'idée étant d'aller cherhcer le user pour ensuite le retourner
        // au format json 
        // A l'époque nous avions un fichier de traitement, qui est aujourd'hui
        // remplacé par ce controller et ce router.
        $reponse =   $UtilisateurController->connexion($email, $password);
        //  Je retourne au format JSON la réponse du controller
        echo json_encode($reponse);

        break;
    case HOME_URL . 'tableaudebord':
        if (isset($_SESSION['connecté'])) {
            $TableauController->index();
            die;
        } else {
            $HomeController->index();
        }
        break;
    default:
        echo json_encode("Nothin here");
}
