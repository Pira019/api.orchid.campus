<?php
namespace App\Virtual\Manager;

/**
 * @OA\Schema(
 *      title="Get country to add tuto",
 *      type="object",
 * )
 */

class CountryStepResponse
{
    /**
     * @OA\Property(
     *      title="id",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $id;
    /**
     * @OA\Property(
     *      title="name",
     *      example="Congo DRC"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="short_name",
     *      example="COD"
     * )
     *
     * @var string
     */
    public $short_name;





}
