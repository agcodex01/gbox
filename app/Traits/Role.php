<?php

namespace App\Traits;

use App\Consts\Roles;

trait Role
{
    public function getRole()
    {
        return Roles::getDisplayName($this->getRoleType());
    }
}
