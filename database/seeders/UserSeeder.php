<?php

namespace Database\Seeders;

use App\Service\ManagerService\UserManagerService;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            "name"=> "LUFUNGULA",
            "first_name" => "Pires",
            "email"=> "pireslfgl243@gmail.com",
            "birth_date"=> "1999-05-01",
            "sex" => "M",
        ];

        UserManagerService::saveSuperAdmin($user);
    }
}
