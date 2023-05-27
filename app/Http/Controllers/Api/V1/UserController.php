<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\newCustomerResource;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Repository\PasswordResetRepository;
use App\Repository\UserRepository;
use App\Rules\Recaptcha;
use App\Service\CustomerServices\CustomerService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function __construct(public UserRepository $userRepository){}

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="create",
     *      tags={"Authentication"},
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
        $request['email'] = strtolower($request['email']);
        
         $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'sex' => 'required|string|max:5',
            'phone' => 'nullable|min:10|max:20',
            'birth_date' => 'required|date|before_or_equal:'.Carbon::now()->subYears(15)->format('d-m-Y'), // Subtract 15 years and set the time to the beginning of the day
            'residence_contry' => 'required|integer|exists:countries,id',
            'citizenship' => 'required|integer|exists:countries,id',
            'email' => 'required|email:rfc,dns|unique:users,email',
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

      /**
     * @OA\Post(
     *      path="/login",
     *      operationId="authentificate",
     *      tags={"Authentication"},
     *      summary="Auth user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/LoginResponse")
     *
     *
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *   @OA\Response(
     *          response=401,
     *          description="Email or password do not match"
     *      ),
     *     )
     */
    public function authentificate(Request $request,Recaptcha $recaptcha)
    {
        $request->validate([
            'email' => ['required','email:rfc,dns'],
            'password' => ['required'],
            'recaptcha' => [$recaptcha],

        ]);
        $request['email'] = strtolower($request['email']);
        $credentials = $request->only('email','password');

       if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'The provided credentials do not match our records'], 401);
        }

       $userToken = $this->userRepository->getLoginToken($credentials['email']);

       return response()->json([
        'access_token' => $userToken
       ]);
    }

      /**
     * @OA\Post(
     *      path="/forgot-password",
     *      operationId="forgotPassword",
     *      tags={"Authentication"},
     *      summary="forgotPassword send token by email",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ForgotPasswordRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Link sent",
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Bad Request"
     *      ),
     *     )
     */
    public function forgotPassword(Request $request,Recaptcha $recaptcha){
        $request->validate([
            'email' => ['required','email'],
            'recaptcha' => [$recaptcha],
        ]);
        $request['email'] = strtolower($request['email']);
        $status = FacadesPassword::sendResetLink($request->only('email'));

        if($status === FacadesPassword::RESET_LINK_SENT){
            return __($status);
        }
        return response()->json(__($status),404);
    }

    public function updatePassword(Request $request,Recaptcha $recaptcha,UserService $userService){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required','confirmed',Password::min(8)->letters()->numbers()->symbols()->uncompromised()],
            'recaptcha' => [$recaptcha],
        ]);

        $request['email'] = strtolower($request['email']);
        $credidentials =  $request->only('email', 'password', 'password_confirmation', 'token');
        $status = $userService->updatePassword($credidentials);

        if($status === FacadesPassword::PASSWORD_RESET){
            return __($status);
        }
        return response()->json(__($status),404);

    }

}
