<?php

namespace App\Service;

use App\Models\User;
use App\Service\ServiceRessource;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService extends ServiceRessource
{
    public function __contruct(User $model)
    {
        $this->model = $model;
    }

    public function save($data)
    {
        return $this->create($data);
    }

    public function userName($name, $idCustomer)
    {
        return substr(strtoupper($name), 0, 2) . date('Hs') . $idCustomer;
    }

    /*
    reset password
     */
    public function updatePassword($credentials)
    {
        $status = Password::reset($credentials, function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status;
    }
}
