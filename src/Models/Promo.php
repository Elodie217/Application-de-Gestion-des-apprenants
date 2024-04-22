<?php

namespace src\Models;

class Promo
{
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
        return ['Id_promo' => $this->getIdPromo(), 'Nom_promo' => $this->getNomPromo(), 'DateDebut_promo' => $this->getDateDebutPromo(), 'DateFin_promo' => $this->getDateFinPromo(), 'Place_promo' => $this->getPlacePromo()];
    }
}
