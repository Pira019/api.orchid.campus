<?php
namespace App\Service\CustomerServices;

use App\Models\Customer;
use App\Service\ServiceRessource;

class CustomerService extends ServiceRessource{

    public function __construct(Customer $customer){

        $this->model = $customer;
    }

    public function save($data){
    return $this->create($data);
    }

}
