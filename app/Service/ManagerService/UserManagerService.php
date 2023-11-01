<?php
namespace App\Service\ManagerService;

use App\Enums\ProfilNameEnum;
use App\Models\Profil;
use App\Models\Customer;
use App\Models\Traits\GeneratesUsername;

class UserManagerService
{
    use GeneratesUsername;

    public function __construct() {}


    public static function saveSuperAdmin(array $data)
    {

        $authService = new AuthService();
        $customerData = self::prepareData($data);
        $customer = Customer::firstOrCreate(self::extractKeys($data,['name','first_name']),$customerData);

        $data['password'] = bcrypt(random_int(100000, 9999999999));

        $userData = self::prepareData($data,['name','first_name','sex','birth_date']);
        
        $userData['user_name'] = self::generatesUsername($customer->name,$customer->id);
        $userData['profil_id'] = Profil::whereName(ProfilNameEnum::SUPER_ADMIN->value)->first()->id;

        $user = $customer->user()->firstOrCreate(self::extractKeys($data,['email']),$userData);
        $authService->attachRole($user);
    }


    static function extractKeys($data ,array $keysToExtract){
        return array_intersect_key($data, array_flip($keysToExtract));
    }

    static function prepareData($data,$keys = ['email']){
      return  array_diff_key($data, array_flip($keys));
    }



}

