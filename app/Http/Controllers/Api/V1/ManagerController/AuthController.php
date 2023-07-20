<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Service\CustomerServices\CustomerService;
use App\Service\ManagerService\AuthService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {}

    public function saveUser(Request $request, CustomerService $customerService, UserService $userService)
    {
        $request['email'] = strtolower($request['email']);
        $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'sex' => 'required|string|max:5',
            'phone' => 'nullable|min:10|max:20',
            'birth_date' => 'required|date|before_or_equal:' . Carbon::now()->subYears(15)->format('d-m-Y'), // Subtract 15 years and set the time to the beginning of the day
            'residence_contry' => 'required|integer|exists:countries,id',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'profil_id' => 'required|integer|exists:profils,id',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt(random_int(100000, 9999999999));

        $newManager = $customerService->save($data);

        $data['user_name'] = $userService->userName($data['name'], $newManager->id);
        $data['customer_id'] = $newManager->id;
        $this->authService->attachRole($userService->save($data));
    }
}
