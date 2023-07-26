<?php

namespace Database\Seeders;

use App\Models\Profil;
use App\Service\ManagerService\ProfileService;
use Illuminate\Database\Seeder;

class ProfileSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     ProfileService::saveRoleAndProfil();
    }
}
