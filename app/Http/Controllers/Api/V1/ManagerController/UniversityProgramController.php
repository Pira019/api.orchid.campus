<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Service\ManagerService\UniversityProgramService;
use Illuminate\Http\Request;

class UniversityProgramController extends Controller
{
    public function __construct(public UniversityProgramService $universityProgram)
    {}

    public function delete($universityProgramId,Request $request)
    {
        $request->merge(['university_program_id' => $request->route('university_program_id')]);
        $request->validate([
            'university_program_id' => 'required|integer|exists:university_program,id',
        ]);

        return $this->universityProgram->destroy($universityProgramId);
    }


}
