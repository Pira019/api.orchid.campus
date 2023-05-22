<?php

namespace App\Service;

use App\Models\User;
use App\Service\ServiceRessource;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserService extends ServiceRessource{
    public function __contruct(){

    }

    public function save($data){
       $this->model=new User();
       $this->create($data);
    }

    public function userName($name,$idCustomer){
        return substr(strtoupper($name),0,2) . date('Hi') . $idCustomer;
    }

    /*
    reset password
    */
    public function updatePassword($credentials){
        $status = Password::reset($credentials,function (User $user, string $password){
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        return $status;
    }
}

