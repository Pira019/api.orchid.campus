<?php
namespace App\Service\ManagerService;

use App\Mail\WelcomeManagerMail;
use App\Models\ProfilRoles;
use Illuminate\Support\Facades\Mail;

class AuthService
{

    public function __construct()
    {
    }

    public function attachRole($user)
    {
        $roles = ProfilRoles::where('profil_id', $user->profil_id)->pluck('role_id');
        $user->syncRoles($roles);

        //send mail
        try {
            Mail::mailer(env("WELCOME_MAILER"))->to($user->email)->send(new WelcomeManagerMail($user));
      } catch (\Exception $e) {}
    }
}
