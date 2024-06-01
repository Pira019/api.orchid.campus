<?php

namespace App\Http\Controllers\Api\v1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Service\SaveDateAdmissionRequest;
use App\Http\Requests\Manager\Service\ShowRequest;
use App\Http\Requests\Manager\StoreServiceRequest;
use App\Http\Resources\Manager\Service\StoreResource;
use App\Http\Resources\Manager\ServiceShowResource;
use App\Repository\Manager\ServiceManagerRepository;
use App\Service\ManagerService\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct(public ServiceService $serviceService, public ServiceManagerRepository $serviceRepository)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->serviceRepository->getAllPaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {

        return new StoreResource($this->serviceService->store($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request)
    {
       return new ServiceShowResource($this->serviceRepository->findService($request->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function saveAdmissionDate(SaveDateAdmissionRequest $request,$serviceId)
    {
        $service = $this->serviceRepository->findOne($serviceId);
        return $this->serviceService->saveServiceAdmissionDate($service,$request->admissionDateIds);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
