<?php
namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *      title="ResonseAuthUser",
 *      description="Response login",
 *      type="object",
 *      required={"token"}
 * )
 */

class LoginResponse
{
    /**
     * @OA\Property(
     *      title="token",
     *      description="generated token"
     * )
     *
     * @var string
     */
    public $token;

}
