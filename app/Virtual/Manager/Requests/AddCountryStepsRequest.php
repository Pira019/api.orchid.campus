<?php
namespace App\Virtual\Manager\Requests;

/**
 * @OA\Schema(
 *      title="AddCountryStepsRequest",
 *      type="object",
 *      required={"title","order","country_id"}
 * )
 */

class AddCountryStepsRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      example="Etape 1"
     * )
     *
     * @var string
     */
    public $title;
    /**
     * @OA\Property(
     *      title="order",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $order;
    /**
     * @OA\Property(
     *      title="c",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $country_id;
    /**
     * @OA\Property(
     *      title="email",
     *      example="description de cette étape"
     * )
     *
     * @var string
     */
    public $description;

}
