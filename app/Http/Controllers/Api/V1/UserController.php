<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\CustomerServices\CustomerService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __contruct(){
    }

    /**
     * @OA\Post(
     *      path="/api/orchid-campus/register",
     *      operationId="create",
     *      tags={"Login"},
     *      summary="Get list of projects lol",
     *      description="Returns list of projects",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *     )
     */
    public function create(Request $request,CustomerService $customerService,UserService $userService){

         $validated= $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'sex' => 'required|string|max:5',
            'birth_date' => 'required|date|before:'.Carbon::now()->subYears(17), // min 17 years
            'residence_contry' => 'nullable|integer|exists:countries,id',
            'citizenship' => 'nullable|integer|exists:countries,id',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',

        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $customer = $customerService->save($data);

        $data['user_name'] = $userService->userName($data['name'],$customer->id);
        $data['customer_id'] = $customer->id;

        $userService->save($data);

        return $customer;
    }


}
