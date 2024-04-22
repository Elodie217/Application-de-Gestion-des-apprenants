<?php

namespace src\Repositories;

use src\Models\Database;
use PDO;
use src\Models\Role;

class RoleRepository
{
    private $db;

    public function __construct()
    {
        $database = new Database;
        $this->db = $database->getDB();
    }

    public function getAllRoles()
    {
        $sql = "SELECT * FROM " . PREFIXE . "role";

        $statement = $this->db->prepare($sql);
        $statement->execute();
        $objets = $statement->fetchAll(PDO::FETCH_CLASS, Role::class);

        $retour =  [];

        foreach ($objets as $objet) {
            array_push($retour, $objet->getObjectToArray());
        }

        return $retour;
    }
}
