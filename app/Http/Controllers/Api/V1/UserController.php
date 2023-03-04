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

    public function create(Request $request,CustomerService $customerService,UserService $userService){

         $validated= $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'sex' => 'required|string|max:5',
            'birth_date' => 'required|date|before:'.Carbon::now()->subYears(17), // min 17 years

            'email' => 'required|email:rfc,dns',
            'password' => 'required',

        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $customer = $customerService->save($data);

        $data['user_name'] = $userService->userName($data['name'],$customer->id);
        $data['customer_id'] = $customer->id;

        User::create($data);

       // $userService->save($data);

        return $customer;
    }


}
