<?php

namespace src\Controllers;

use src\Services\Reponse;

class TableauController
{
    use Reponse;


    function index()
    {
        if (isset($_GET['erreur'])) {
            $erreur = htmlspecialchars($_GET['erreur']);
        } else {
            $erreur = '';
        }

        $this->render("tableauDeBord", ["erreur" => $erreur]);
    }
}
