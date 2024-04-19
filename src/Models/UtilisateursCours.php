<?php

namespace src\Models;

class UtilisateursCours
{
    private $Id_cours;
    private $Id_utilisateur;
    private $Absence_UtilisateursCours;
    private $Retard_UtilisateursCours;


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
     * Get the value of Id_cours
     */
    public function getIdCours()
    {
        return $this->Id_cours;
    }

    /**
     * Set the value of Id_cours
     */
    public function setIdCours($Id_cours): self
    {
        $this->Id_cours = $Id_cours;

        return $this;
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
     * Get the value of Absence_UtilisateursCours
     */
    public function getAbsenceUtilisateursCours()
    {
        return $this->Absence_UtilisateursCours;
    }

    /**
     * Set the value of Absence_UtilisateursCours
     */
    public function setAbsenceUtilisateursCours($Absence_UtilisateursCours): self
    {
        $this->Absence_UtilisateursCours = $Absence_UtilisateursCours;

        return $this;
    }

    /**
     * Get the value of Retard_UtilisateursCours
     */
    public function getRetardUtilisateursCours()
    {
        return $this->Retard_UtilisateursCours;
    }

    /**
     * Set the value of Retard_UtilisateursCours
     */
    public function setRetardUtilisateursCours($Retard_UtilisateursCours): self
    {
        $this->Retard_UtilisateursCours = $Retard_UtilisateursCours;

        return $this;
    }

    public function getObjectToArray(): array
    {
        return ['Id_cours' => $this->getIdCours(), 'Id_utilisateur' => $this->getIdUtilisateur(), 'Absence_UtilisateursCours' => $this->getAbsenceUtilisateursCours(), 'Retard_UtilisateursCours' => $this->getRetardUtilisateursCours()];
    }
}
