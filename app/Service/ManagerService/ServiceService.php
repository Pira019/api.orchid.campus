<?php
namespace App\Service\ManagerService;

use App\Models\Service;
use App\Service\ServiceRessource;

class ServiceService extends ServiceRessource{

    public function __construct(Service $model){
        $this->model = $model;
    }


    public function store($data)
    {

        $disciplinarySectorsIds = explode(',',$data['service_disciplinaries']);
        $service = $this->create($data);
        //save
        $service->disciplinaries()->sync($disciplinarySectorsIds);
        return $service;
    }

    public function saveServiceAdmissionDate($service,array $dateAdmissionIds)
    {
         $service->admissionDates()->syncWithoutDetaching($dateAdmissionIds);
    }


}
