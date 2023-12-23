<?php
namespace App\Repository\Manager;

use App\Models\Program;
use App\Repository\RepositoryRessource;
use Illuminate\Support\Facades\DB;

class UniversityProgramRepository extends RepositoryRessource
{

    public function __construct(Program $model)
    {
        $this->model = $model;
    }


    public function getProgramDetailToPrefil(){

       $programs = $this->model->select('label as name')->orderBy('label')->get();
       $disciplineSector = DB::table('disciplinary_sectors')->select('label','description')->orderBy('label')->get();

       return [
        'programs' => $programs,
        'disciplines' => $disciplineSector
       ];

    }


}
