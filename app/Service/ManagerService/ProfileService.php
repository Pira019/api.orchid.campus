<?php

namespace App\Service\ManagerService;

use App\Enums\ProfilNameEnum;
use App\Models\Profil; 

class ProfileService
{
    public static function saveRoleAndProfil()
    {
        $profilNames = [];
        foreach (ProfilNameEnum::cases() as $roleName) {
            $profilNames[] = [
                "name" => $roleName,
            ];
        };
        Profil::insertOrIgnore($profilNames);
    }

}
