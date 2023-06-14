<?php

namespace App\Enums;

enum TokenAbilitiesEnum:string
{
    case Update  = 'server:update';
    case Create  = 'server:create';
    case Destroy = 'server:destroy';
}
