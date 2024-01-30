<?php
namespace App\Enums;

enum ProfilNameEnum : String
{

    case MANAGER = "Manager";
    case ADMIN = "Admin";
    case SUPER_ADMIN = "Super-Admin";

    public static function getValues()
    {
        return collect(self::cases())->map->value->all();
    }
}

