<?php
namespace App\Enums;

enum StatusServiceEnum : String
{

    case PUBLIE = "PUBLIBLIE";
    case DESACTIVEE = "DESACTIVE";
    case NON_PUBLIE = "NON_PUBLIE";

    public static function getValues()
    {
        return collect(self::cases())->map->value->all();
    }
}

