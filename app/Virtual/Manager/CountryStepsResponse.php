<?php
namespace App\Virtual\Manager;

/**
 * @OA\Schema(
 *      title="CountryStepsResponse",
 *      type="object"
 * )
 */

class CountryStepsResponse
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
     *      title="country_id",
     *      example="38"
     * )
     *
     * @var integer
     */
    public $country_id;
    /**
     * @OA\Property(
     *      title="title",
     *      example="Titre etape 1"
     * )
     *
     * @var string
     */
    public $title;

      /**
     * @OA\Property(
     *      title="order",
     *      example="1",
     *      description="order of step"
     * )
     *
     * @var integer
     */
    public $order;

    /**
     * @OA\Property(
     *      title="description",
     *      description="desciprion étape"
     * )
     *
     * @var string
     */
    public $description;

     /**
     * @OA\Property(
     *      title="comment"
     * )
     *
     * @var string
     */
    public $comment;

     /**
     * @OA\Property(
     *      title="visibility",
     *      description="true or false"
     * )
     *
     * @var boolean
     */
    public $visibility;

     /**
     * @OA\Property(
     *      title="created_at",
     * )
     *
     * @var string
     */
    public $created_at;

      /**
     * @OA\Property(
     *      title="updated_at",
     * )
     *
     * @var string
     */
    public $updated_at;




}
