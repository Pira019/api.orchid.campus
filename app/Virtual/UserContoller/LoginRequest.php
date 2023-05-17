<?php
namespace App\Virtual\UserContoller;

/**
 * @OA\Schema(
 *      title="Auth user",
 *      description="Auth user",
 *      type="object",
 *      required={"email","password"}
 * )
 */

class LoginRequest
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

    /**
     * @OA\Property(
     *      title="first_name",
     *      example="1234"
     * )
     *
     * @var string
     */
    public $password;

     /**
     * @OA\Property(
     *      title="sex",
     *      example="M",
     *      description="Choose the sex M or F",
     * )
     *
     * @var string
     */

}
