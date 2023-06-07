<?php

namespace App\Http\Controllers\Api\V1\CustomerController\Contact;

use App\Http\Controllers\Controller;
use App\Rules\Recaptcha;
use App\Service\CustomerServices\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(public ContactService $contactService){}

      /**
     * @OA\Post(
     *      path="/question",
     *      operationId="sendEmail",
     *      tags={"Contact"},
     *      summary="Question from user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ContactFormRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",     *
     *       ),
     *       @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *       @OA\Response(
     *          response=422,
     *          description="Cannot process it due to validation errors"
     *      ),
     *     )
     */
    public function sendEmail(Request $request,Recaptcha $recaptcha)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns',
            'message' => 'required',
            'recaptcha' => [$recaptcha],

        ]);

        $this->contactService->sendEmail($request->all());
    }
}
