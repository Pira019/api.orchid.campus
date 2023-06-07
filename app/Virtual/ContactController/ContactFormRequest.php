<?php
namespace App\Virtual\ContactController;

/**
 * @OA\Schema(
 *      title="Contact form",
 *      description="contact form",
 *      type="object",
 *      required={"email","name","message"}
 * )
 */

class ContactFormRequest
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
     *      title="name",
     *      example="Anelka"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="email",
     *      example="J'ai une question"
     * )
     *
     * @var string
     */
    public $message;

}
