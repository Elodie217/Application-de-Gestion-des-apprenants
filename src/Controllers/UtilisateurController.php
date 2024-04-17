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

    public function creerApprenant($nomApprenant, $prenomApprenant, $emailApprenant, $roleApprenant, $idPromo)
    {
        if (isset($nomApprenant) && !empty($nomApprenant) && isset($prenomApprenant) && !empty($prenomApprenant) && isset($emailApprenant) && !empty($emailApprenant) && isset($roleApprenant) && !empty($roleApprenant)) {

            if (filter_var($emailApprenant, FILTER_VALIDATE_EMAIL)) {
                $nomApprenant = htmlspecialchars($nomApprenant);
                $prenomApprenant = htmlspecialchars($prenomApprenant);
                $emailApprenant = htmlspecialchars($emailApprenant);
                $roleApprenant = htmlspecialchars($roleApprenant);


                $utilisateurRepository = new UtilisateurRepository;
                $reponse = $utilisateurRepository->sauvegarderApprenant($nomApprenant, $prenomApprenant, $emailApprenant, $roleApprenant, $idPromo);
                return json_encode($reponse);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Merci de remplir un email valide.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }

    public function recupererApprenant($idApprenant)
    {
        $utilisateurRepository = new UtilisateurRepository;
        $reponse = $utilisateurRepository->recupererApprenant($idApprenant);
        return json_encode($reponse);
    }

    public function editApprenant($Id_utilisateur, $nomApprenantEdit, $prenomApprenantEdit, $emailApprenantEdit, $compteApprenantEdit)
    {
        if (isset($Id_utilisateur) && !empty($Id_utilisateur) && isset($nomApprenantEdit) && !empty($nomApprenantEdit) && isset($prenomApprenantEdit) && !empty($prenomApprenantEdit) && isset($emailApprenantEdit) && !empty($emailApprenantEdit)) {

            if (filter_var($emailApprenantEdit, FILTER_VALIDATE_EMAIL)) {
                $Id_utilisateur = htmlspecialchars($Id_utilisateur);
                $nomApprenantEdit = htmlspecialchars($nomApprenantEdit);
                $prenomApprenantEdit = htmlspecialchars($prenomApprenantEdit);
                $emailApprenantEdit = htmlspecialchars($emailApprenantEdit);


                $utilisateurRepository = new UtilisateurRepository;
                $reponse = $utilisateurRepository->editApprenant($Id_utilisateur, $nomApprenantEdit, $prenomApprenantEdit, $emailApprenantEdit, $compteApprenantEdit);
                return json_encode($reponse);
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Merci de remplir un email valide.'
                );
                return json_encode($response);
                die;
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Merci de remplir tous les champs.'
            );
            return json_encode($response);
            die;
        }
    }

    public function supprApprenant($Id_apprenant)
    {
        $utilisateurRepository = new UtilisateurRepository;
        $reponse = $utilisateurRepository->supprApprenant($Id_apprenant);
        return json_encode($reponse);
    }
}
