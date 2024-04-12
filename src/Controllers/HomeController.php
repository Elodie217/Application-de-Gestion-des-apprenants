<?php

namespace src\Controllers;

use src\Services\Reponse;

class HomeController
{

    use Reponse;

    public function index(): void
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("index", ["erreur" => $erreur]);
    }

    public function auth(string $password): void
    {
        if ($password === 'admin') {
            $_SESSION['connecté'] = TRUE;
            header('location: ' . HOME_URL . 'dashboard');
            die();
        } else {
            header('location: ' . HOME_URL . '?erreur=connexion');
        }
    }

    public function deconnexion()
    {
        session_destroy();
        // header('Location: ' . HOME_URL);
        // die();
        return 'success';
    }

    public function page404(): void
    {
        header("HTTP/1.1 404 Not Found");
        $this->render('404');
    }
}
