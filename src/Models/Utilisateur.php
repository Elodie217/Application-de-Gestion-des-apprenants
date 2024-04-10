<?php

namespace src\Models;

class Utilisateur
{
    private $Id_utilisateur;
    private $Nom_utilisateur;
    private $Prenom_utilisateur;
    private $MotDePasse_utilisateur;
    private $Activiation_utilisateur;
    private $Email_utilisateur;
    private $Id_role;


    function __construct(array $datas = array())
    {
        foreach ($datas as $key => $value) {
            $parts = explode('_', $key);
            $setter = 'set';
            foreach ($parts as $part) {
                $setter .= ucfirst(strtolower($part));
            }

            $this->$setter($value);
        }
    }

    /**
     * Get the value of Id_utilisateur
     */
    public function getIdUtilisateur()
    {
        return $this->Id_utilisateur;
    }

    /**
     * Set the value of Id_utilisateur
     */
    public function setIdUtilisateur($Id_utilisateur): self
    {
        $this->Id_utilisateur = $Id_utilisateur;

        return $this;
    }

    /**
     * Get the value of Nom_utilisateur
     */
    public function getNomUtilisateur()
    {
        return $this->Nom_utilisateur;
    }

    /**
     * Set the value of Nom_utilisateur
     */
    public function setNomUtilisateur($Nom_utilisateur): self
    {
        $this->Nom_utilisateur = $Nom_utilisateur;

        return $this;
    }

    /**
     * Get the value of Prenom_utilisateur
     */
    public function getPrenomUtilisateur()
    {
        return $this->Prenom_utilisateur;
    }

    /**
     * Set the value of Prenom_utilisateur
     */
    public function setPrenomUtilisateur($Prenom_utilisateur): self
    {
        $this->Prenom_utilisateur = $Prenom_utilisateur;

        return $this;
    }

    /**
     * Get the value of MotDePasse_utilisateur
     */
    public function getMotDePasseUtilisateur()
    {
        return $this->MotDePasse_utilisateur;
    }

    /**
     * Set the value of MotDePasse_utilisateur
     */
    public function setMotDePasseUtilisateur($MotDePasse_utilisateur): self
    {
        $this->MotDePasse_utilisateur = $MotDePasse_utilisateur;

        return $this;
    }

    /**
     * Get the value of Activiation_utilisateur
     */
    public function getActiviationUtilisateur()
    {
        return $this->Activiation_utilisateur;
    }

    /**
     * Set the value of Activiation_utilisateur
     */
    public function setActiviationUtilisateur($Activiation_utilisateur): self
    {
        $this->Activiation_utilisateur = $Activiation_utilisateur;

        return $this;
    }

    /**
     * Get the value of Email_utilisateur
     */
    public function getEmailUtilisateur()
    {
        return $this->Email_utilisateur;
    }

    /**
     * Set the value of Email_utilisateur
     */
    public function setEmailUtilisateur($Email_utilisateur): self
    {
        $this->Email_utilisateur = $Email_utilisateur;

        return $this;
    }

    /**
     * Get the value of Id_role
     */
    public function getIdRole()
    {
        return $this->Id_role;
    }

    /**
     * Set the value of Id_role
     */
    public function setIdRole($Id_role): self
    {
        $this->Id_role = $Id_role;

        return $this;
    }
}
