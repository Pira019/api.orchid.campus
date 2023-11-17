<?php
namespace App\Repository\Manager;

use App\Models\University;
use App\Repository\RepositoryRessource;

class UniversityRepository extends RepositoryRessource
{

    public function __construct(University $model)
    {
        $this->model = $model;
    }

    public function getByCountryId($countryId)
    {

        return $this->model->whereHas('city.country', fn($query) => $query->where('id', $countryId))
            ->with(['city:name,id,country_id'])
            ->select('name', 'city_id', 'id')
            ->orderBy('universities.name')
            ->get();
    }

    public function findById($id)
    {
        return $this->model
            ->with(['address:university_id,code_postal,adress,updated_at',
                'city:name,id,country_id',
                'city.country:id,name,flag_url'])
            ->find($id)->makeHidden('created_at');
    }

    public function getProgramsByUniversityId($universityId){

        return $this->findOne($universityId)->programs()
        ->leftJoin('disciplinary_sectors', 'programs.disciplinary_sector_id', '=', 'disciplinary_sectors.id')
        ->select("disciplinary_sectors.label as disciplinary_sector","programs.label as title")
        ->orderBy('cycle')
        ->orderBy('title')
        ->get();

    }

}
