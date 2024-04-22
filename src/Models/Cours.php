<?php

namespace src\Models;

class Cours
{

    private $Id_cours;
    private $Date_cours;
    private $HeureDebut_cours;
    private $HeureFin_cours;
    private $Code_cours;
    private $Id_promo;
    private $Nom_promo;
    private $DateDebut_promo;
    private $DateFin_promo;
    private $Place_promo;

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
     * Get the value of Date_cours
     */
    public function getDateCours()
    {
        return $this->Date_cours;
    }

    /**
     * Set the value of Date_cours
     */
    public function setDateCours($Date_cours): self
    {
        $this->Date_cours = $Date_cours;

        return $this;
    }

    /**
     * Get the value of HeureDebut_cours
     */
    public function getHeureDebutCours()
    {
        return $this->HeureDebut_cours;
    }

    /**
     * Set the value of HeureDebut_cours
     */
    public function setHeureDebutCours($HeureDebut_cours): self
    {
        $this->HeureDebut_cours = $HeureDebut_cours;

        return $this;
    }

    /**
     * Get the value of HeureFin_cours
     */
    public function getHeureFinCours()
    {
        return $this->HeureFin_cours;
    }

    /**
     * Set the value of HeureFin_cours
     */
    public function setHeureFinCours($HeureFin_cours): self
    {
        $this->HeureFin_cours = $HeureFin_cours;

        return $this;
    }

    /**
     * Get the value of Code_cours
     */
    public function getCodeCours()
    {
        return $this->Code_cours;
    }

    /**
     * Set the value of Code_cours
     */
    public function setCodeCours($Code_cours): self
    {
        $this->Code_cours = $Code_cours;

        return $this;
    }

    /**
     * Get the value of Id_promo
     */
    public function getIdPromo()
    {
        return $this->Id_promo;
    }

    /**
     * Set the value of Id_promo
     */
    public function setIdPromo($Id_promo): self
    {
        $this->Id_promo = $Id_promo;

        return $this;
    }

    /**
     * Get the value of Nom_promo
     */
    public function getNomPromo()
    {
        return $this->Nom_promo;
    }

    /**
     * Set the value of Nom_promo
     */
    public function setNomPromo($Nom_promo): self
    {
        $this->Nom_promo = $Nom_promo;

        return $this;
    }

    /**
     * Get the value of DateDebut_promo
     */
    public function getDateDebutPromo()
    {
        return $this->DateDebut_promo;
    }

    /**
     * Set the value of DateDebut_promo
     */
    public function setDateDebutPromo($DateDebut_promo): self
    {
        $this->DateDebut_promo = $DateDebut_promo;

        return $this;
    }

    /**
     * Get the value of DateFin_promo
     */
    public function getDateFinPromo()
    {
        return $this->DateFin_promo;
    }

    /**
     * Set the value of DateFin_promo
     */
    public function setDateFinPromo($DateFin_promo): self
    {
        $this->DateFin_promo = $DateFin_promo;

        return $this;
    }

    /**
     * Get the value of Place_promo
     */
    public function getPlacePromo()
    {
        return $this->Place_promo;
    }

    /**
     * Set the value of Place_promo
     */
    public function setPlacePromo($Place_promo): self
    {
        $this->Place_promo = $Place_promo;

        return $this;
    }

    public function getObjectToArray(): array
    {
        return ['Id_cours' => $this->getIdCours(), 'Date_cours' => $this->getDateCours(), 'HeureDebut_cours' => $this->getHeureDebutCours(), 'HeureFin_cours' => $this->getHeureFinCours(), 'Code_cours' => $this->getCodeCours(), 'Id_promo' => $this->getIdPromo(), 'Nom_promo' => $this->getNomPromo(), 'DateDebut_promo' => $this->getDateDebutPromo(), 'DateFin_promo' => $this->getDateFinPromo(), 'Place_promo' => $this->getPlacePromo()];
    }
}
