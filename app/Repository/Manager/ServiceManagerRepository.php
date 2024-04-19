<?php
namespace App\Repository\Manager;

use App\Models\Service;
use App\Repository\RepositoryRessource;
use stdClass;

class ServiceManagerRepository extends RepositoryRessource
{

    public function __construct(Service $model)
    {
        $this->model = $model;
    }

    public function getAllPaginate()
    {
        return $this->model::
            with(['country' => fn($query) => $query->select('id', 'name', 'flag_url')])
            ->paginate(5);
    }

    public function findService($serviceId)
    {
        $service = $this->findOne($serviceId);
        $countryId = $service->country_id;
        $disciplinaryIds = $service->disciplinaries->pluck('id')->toArray();

        $universities = UniversityRepository::getUniversitiesBycountryIdAnddisciplaryIds($countryId,$disciplinaryIds);

        $service =  $service->load(['disciplinaries', 'country.countrySteps'=>fn($query) => $query->select('country_id','id','title','visibility','description')->orderBy('order')]);

        $result = new stdClass;
        $result->universities = $universities;
        $result->service = $service;

       return $result;
    }

}
