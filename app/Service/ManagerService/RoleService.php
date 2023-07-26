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
        self::defaultAttachProfileRole("Admin");
        self::defaultAttachProfileRole("Manager", false);
    }

    public static function defaultAttachProfileRole($profilName, $admin = true)
    {
        $findProfile = Profil::whereName($profilName)->first(['id']);
        //get role
        $roleId = Role::when(!$admin, fn($query) => $query->where('name', $profilName))->get(['id']);

        $findProfile->roles()->sync($roleId);

    }

}
