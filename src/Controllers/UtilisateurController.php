<?php

namespace src\Controllers;

use src\Repositories\UtilisateurRepository;

class UtilisateurController
{


    public function connexion()
    {
        if (isset($_POST)) {
            $data = file_get_contents("php://input");
            $utilisateur = (json_decode($data, true));


            if (isset($utilisateur['emailConnexion']) && !empty($utilisateur['emailConnexion']) && isset($utilisateur['motDePasseConnexion']) && !empty($utilisateur['motDePasseConnexion'])) {
                $utilisateurRepository = new UtilisateurRepository();

                if (filter_var($utilisateur['emailConnexion'], FILTER_VALIDATE_EMAIL)) {
                    $email = htmlspecialchars($utilisateur['emailConnexion']);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Email invalide'
                    );
                    echo json_encode($response);
                    die();
                }

                if ($utilisateurRepository->connexion($email, $utilisateur["motDePasseConnexion"])) {
                    $utilisateurConnecte = $utilisateurRepository->getUtilisateurbyEmail($email);
                    $roleUtilisateur = $utilisateurConnecte->getIdRole();
                    $_SESSION['connecté'] = $utilisateurConnecte->getIdUtilisateur();
                    $_SESSION['role'] = $roleUtilisateur;
                    $response = array(
                        'status' => 'success',
                        'role' => $roleUtilisateur
                    );
                    echo json_encode($response);
                    die();
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Identifiants incorrects'
                    );
                    echo json_encode($response);
                    die();
                }
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Merci de remplir tous les champs.'
                );
                echo json_encode($response);
                die();
            }
        }
    }

    public function ApprenantsByIdPromo($idPromo)
    {
        $utilisateurRepository = new UtilisateurRepository;
        $reponse = $utilisateurRepository->getApprenantsbyIdPromo($idPromo);
        return json_encode($reponse);
    }
}
