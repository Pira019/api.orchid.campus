<?php
namespace App\Virtual\Manager\Requests;

/**
 * @OA\Schema(
 *      title="EditStepRequest",
 *      type="object",
 * )
 */

class EditStepRequest
{
    /**
     * @OA\Property(
     *      title="title",
     *      example="ex title",
     *      description="No indentification",
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
     *      title="description",
     *      example="ex description",
     *      description="exemple description",
     * )
     *
     * @var string
     */
    public $description;

}
