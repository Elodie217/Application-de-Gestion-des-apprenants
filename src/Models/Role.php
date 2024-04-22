<?php

namespace src\Models;

class Role
{
    private $Id_role;
    private $Nom_role;


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

    /**
     * Get the value of Nom_role
     */
    public function getNomRole()
    {
        return $this->Nom_role;
    }

    /**
     * Set the value of Nom_role
     */
    public function setNomRole($Nom_role): self
    {
        $this->Nom_role = $Nom_role;

        return $this;
    }

    public function getObjectToArray(): array
    {
        return ['Id_role' => $this->getIdRole(), 'Nom_role' => $this->getNomRole()];
    }
}
