<?php

namespace App\Contracts;

interface HasRole
{
    public function getRoleType(): string;
}
