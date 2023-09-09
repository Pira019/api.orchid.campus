<?php
namespace App\Virtual\Manager;

/**
 * @OA\Schema(
 *      title="StepsOfCountryResponse",
 *      type="object",
 *      description="List of country steps"
 * )
 */

class StepsOfCountryResponse
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

      /**
     * @OA\Property(
     *      title="name",
     *      example="Canada",
     *      description="name of country",
     * )
     *
     * @var string
     */
    public $short_name;

    /**
     * @OA\Property(
     *      title="country_steps",
     *      description="Array of country steps",
     *      @OA\Items(ref="#/components/schemas/CountryStepsResponse")
     * )
     *
     * @var array
     */
    public $country_steps;




}
