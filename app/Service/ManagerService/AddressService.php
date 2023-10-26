<?php
namespace App\Service\ManagerService;

use App\Models\Address;
use App\Service\ServiceRessource;

class AddressService extends ServiceRessource
{

    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function updateUniversityAddress(array $data){

         $universityId =  $data['university_id'];
         return  $this->model->updateOrCreate(['university_id' => $universityId],$data)->makeHidden(['id','created_at']);
    }


}
