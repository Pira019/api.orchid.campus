<?php

namespace App\Http\Controllers\Api\V1\ManagerController;

use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use App\Rules\Recaptcha;
use App\Service\CustomerServices\CustomerService;
use App\Service\ManagerService\AuthService;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService,public UserRepository $userRepository)
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


       /**
     * @OA\Post(
     *      path="/manager/login",
     *      operationId="authentication",
     *      tags={"ManagerAuth"},
     *      summary="Auth manager",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ManagerLoginRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",     *
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *           @OA\JsonContent(ref="#/components/schemas/ManagerLoginResponse")
     *
     *
     *       ),
     *     )
     */
    public function authentication(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string|max:255',
            'recaptcha' => [$recaptcha],
        ]);

        $crententials = $request->only('user_name','password');

        if (!Auth::guard('manager')->attempt($crententials,true)) {
            return response()->json([
                'message' => 'The provided credentials do not match our records'], 401);
        }

        $user= $this->userRepository->getLoginToken($crententials['user_name'],"user_name");

        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'name' => $user->customer->first_name.' ' . $user->customer->name,
           ]);

    }

    //send token to reset password
    public function forgotPassword(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'user_name' => 'required|string',
            'recaptcha' => [$recaptcha],
        ]);

        $userEmail = $this->userRepository->getFirst("user_name",$request["user_name"],["email"])?->email;

        if(!$userEmail){
            return response()->json([
                'message' => "Erreur no indentification"],404
            );
        }

        $status = Password::sendResetLink(["email" => $userEmail]);

        if($status === Password::RESET_LINK_SENT){
            return __($status);
        }

        return response()->json(__($status),404);;
    }

    //reset password
    public function updatePassword(Request $request,Recaptcha $recaptcha,UserService $userService){
        $request->validate([
            'token' => 'required',
            'user_name' => 'required',
            'password' => ['required','confirmed',RulesPassword::min(8)->letters()->numbers()->symbols()->uncompromised()],
            'recaptcha' => [$recaptcha],
        ]);

        $userEmail = $this->userRepository->getFirst("user_name",$request["user_name"],["email"])?->email;

        if(!$userEmail){
            return response()->json([
                'message' => "Erreur no indentification"],404
            );
        }

        $request['email'] = $userEmail;
        $credidentials =  $request->only('email', 'password', 'password_confirmation', 'token');

        $status = $userService->updatePassword($credidentials);

        if($status === Password::PASSWORD_RESET){
            return __($status);
        }
        return response()->json(__($status),404);

    }
}
