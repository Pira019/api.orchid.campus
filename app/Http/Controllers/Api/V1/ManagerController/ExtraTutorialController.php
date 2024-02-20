<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Service\ManagerService\ExtraTutorialService;
use Illuminate\Http\Request;

class ExtraTutorialController extends Controller
{
    public function __construct(public ExtraTutorialService $extraTutorialService)
    {}

    public function delete($id,$videoId,Request $request)
    {
        $request->merge([
            'id' =>$id,
            'video_identifier' =>$videoId
        ]);
        $request->validate([
            'id' =>'required|integer|exists:extra_tutorials,id',
            'video_identifier' =>'required',
        ]); 
        
         return $this->extraTutorialService->deleteVideo($id,$videoId);
    }
}
