<?php
namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Http\Resources\Manager\ProfileManagerResource;
use App\Repository\Manager\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(public UserRepository $userRepository)
    {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->merge([
            'id' => $request->user()->id
        ]);
        $request->validate([
            'id' =>'required|integer|exists:users',
        ]);

        return new ProfileManagerResource($this->userRepository->findUser($request->id));
    }

}
