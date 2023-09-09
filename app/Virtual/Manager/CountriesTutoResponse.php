<?php
namespace App\Virtual\Manager;

/**
 * @OA\Schema(
 *      title="CountriesTutoResponse",
 *      type="object",
 * )
 */

class CountriesTutoResponse
{
    /**
     * @OA\Property(
     *      title="id",
     *      example="1",
     *      description="country id",
     * )
     *
     * @var integer
     */
    public $id;
    /**
     * @OA\Property(
     *      title="flag_url",
     *      description="image flag svg url form api restCounrty",
     * )
     *
     * @var string
     */
    public $flag_url;
    /**
     * @OA\Property(
     *      title="name",
     *      example="Canada",
     *      description="name of country",
     * )
     *
     * @var string
     */
    public $name;





}
