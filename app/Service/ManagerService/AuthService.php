<?php
namespace App\Service\ManagerService;

use App\Models\ProfilRoles;
use App\Service\ServiceRessource;

class AuthService extends ServiceRessource
{


    public function __construct()
    {
    }

    public function attachRole($user)
    {
        $roles =ProfilRoles::where('profil_id',$user->profil_id)->pluck('role_id');
        $user->syncRoles($roles);
    }
}
