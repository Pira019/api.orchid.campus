<?php
namespace App\Virtual\UserContoller;

/**
 * @OA\Schema(
 *      title="Update password",
 *      description="Update password",
 *      type="object",
 *      required={"token","email","password","password_confirmation"}
 * )
 */

class UpdatePasswordRequest
{
    /**
     * @OA\Property(
     *      title="token",
     *      description="token sent by email",
     * )
     *
     * @var string
     */
    public $token;


     /**
     * @OA\Property(
     *      title="email",
     *      example="exemple@orchid-campus.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      example="1234",
     * )
     *
     * @var string
     */
    public $password;

     /**
     * @OA\Property(
     *      title="password_confirmation",
     *      example="1234",
     * )
     *
     * @var string
     */
    public $password_confirmation;

}
