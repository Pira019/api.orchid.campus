<?php
namespace App\Virtual\UserContoller;

/**
 * @OA\Schema(
 *      title="ForgotPasswordRequest",
 *      description="ForgotPasswordRequest",
 *      type="object",
 *      required={"email"}
 * )
 */

class ForgotPasswordRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      example="exempel@domaine.com"
     * )
     *
     * @var string
     */
    public $email;

}
