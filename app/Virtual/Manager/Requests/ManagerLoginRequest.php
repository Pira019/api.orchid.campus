<?php
namespace App\Virtual\Manager\Requests;

/**
 * @OA\Schema(
 *      title="ManagerLoginRequest",
 *      type="object",
 *      required={"user_name","password"}
 * )
 */

class ManagerLoginRequest
{
    /**
     * @OA\Property(
     *      title="user_name",
     *      example="MP20256",
     *       description="No indentification",
     * )
     *
     * @var string
     */
    public $user_name;

    /**
     * @OA\Property(
     *      title="password",
     *      example="1234"
     * )
     *
     * @var string
     */
    public $password;

}
