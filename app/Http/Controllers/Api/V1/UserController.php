<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\newCustomerResource;
use App\Mail\WelcomeMail;
use App\Rules\Recaptcha;
use App\Service\CustomerServices\CustomerService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function __contruct(){
    }

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="create",
     *      tags={"Register"},
     *      summary="Save new user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SaveNewUserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",     *
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *     )
     */
    public function create(Request $request,CustomerService $customerService,UserService $userService,Recaptcha $recaptcha){

         $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'sex' => 'required|string|max:5',
            'phone' => 'nullable|min:10|max:20',
            'birth_date' => 'required|date|before_or_equal:'.Carbon::now()->subYears(15)->format('d-m-Y'), // Subtract 15 years and set the time to the beginning of the day
            'residence_contry' => 'nullable|integer|exists:countries,id',
            'citizenship' => 'nullable|integer|exists:countries,id',
            'email' => 'required|email:rfc,dns|unique:users',
            'password_confirmation' => 'required|same:password',
            'password' => ['required',Password::min(8)->letters()->numbers()->symbols()->uncompromised()],
            'recaptcha' => [$recaptcha],

        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $customer = $customerService->save($data);

        $data['user_name'] = $userService->userName($data['name'],$customer->id);
        $data['customer_id'] = $customer->id;

        $userService->save($data);

        //send welcome email
        Mail::mailer('welcome')->to($data['email'])->send(new WelcomeMail($customer->first_name));

        return new newCustomerResource($customer);
    }


}
