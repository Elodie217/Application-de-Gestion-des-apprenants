<?php

namespace src\Controllers;

use src\Repositories\RoleRepository;

class RoleController
{
    function recupererRoles()
    {
        $RoleRepository = new RoleRepository;
        $reponse = $RoleRepository->getAllRoles();
        return json_encode($reponse);
    }
}
