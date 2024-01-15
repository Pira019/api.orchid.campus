<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Service\ManagerService\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct(public SettingService $settingService )
    {}




    public function createWaterMark(Request $request)
    {

        $request->validate([
            'name' =>'required|string|max:55',
            'file' =>'required|file|mimes:png|max:2048',
        ]);   
        return $this->settingService->saveWatermark($request->file('file'),$request->name);
    }






}
