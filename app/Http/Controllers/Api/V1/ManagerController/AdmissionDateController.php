<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\AdmissionRequest;
use App\Http\Resources\AddAdmissionResource;
use App\Service\ManagerService\AdmissionDateService;

class AdmissionDateController extends Controller
{
    public function __construct(public AdmissionDateService $admissionDateService)
    {}

    public function store(AdmissionRequest $admissionRequest)
    {
       $data = $admissionRequest->validated();

       return new AddAdmissionResource($this->admissionDateService->create($data));
    }

}
