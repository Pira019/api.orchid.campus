<?php
namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *      title="ManagerLoginResponse",
 *      description="Response login",
 *      type="object",
 *      required={"token","name"}
 * )
 */

class ManagerLoginResponse
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

    /**
     * @OA\Property(
     *      title="token",
     *      description="generated token"
     * )
     *
     * @var string
     */
    public $name;

}
