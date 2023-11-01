<?php

namespace App\Service\ManagerService;

use App\Enums\ProfilNameEnum;
use App\Models\Profil;
use App\Models\Role;

class RoleService
{

    public function __construct()
    {}

    public static function saveRole()
    {
        $roleNames = [];
        foreach (ProfilNameEnum::cases() as $roleName) {
            $roleNames[] = [
                "name" => $roleName,
                "guard_name" => "manager",
            ];
        };
        Role::insertOrIgnore($roleNames);
        self::defaultAttachProfileRole(ProfilNameEnum::ADMIN->value);
        self::defaultAttachProfileRole(ProfilNameEnum::MANAGER->value, false);
        self::defaultAttachProfileRole(ProfilNameEnum::SUPER_ADMIN->value, false, true);
    }

    public static function defaultAttachProfileRole($profilName, $admin = true, $isSuperAdmin = false)
    {
        $findProfile = Profil::whereName($profilName)->first(['id']);
        //get role
        $roleId = Role::when(!$admin && !$isSuperAdmin, fn($query) => $query->where('name', $profilName))
            ->when($admin && !$isSuperAdmin, fn($query) => $query->whereNot('name',ProfilNameEnum::SUPER_ADMIN->value))
            ->get(['id']);

        $findProfile->roles()->sync($roleId);

    }

}

