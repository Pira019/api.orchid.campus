<?php
namespace App\Virtual\UserContoller;

/**
 * @OA\Schema(
 *      title="Save NewUserRequest request",
 *      description="Create user account request body data",
 *      type="object",
 *      required={"name","first_name","sex","birth_date","residence_contry","citizenship","email","password","password_confirmation"}
 * )
 */

class SaveNewUserRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      example="LUFUNGULA"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="first_name",
     *      example="Nico"
     * )
     *
     * @var string
     */
    public $first_name;

     /**
     * @OA\Property(
     *      title="sex",
     *      example="M",
     *      description="Choose the sex M or F",
     * )
     *
     * @var string
     */
    public $sex;

     /**
     * @OA\Property(
     *      title="phone",
     *      example="8169394833",
     *      description="Phone number",
     * )
     *
     * @var string
     */
    public $phone;

    /**
     * @OA\Property(
     *      title="birth_date",
     *      example="2000-01-12",
     *      format="date"
     * )
     *
     * @var string
     */
    public $birth_date;

    /**
     * @OA\Property(
     *      title="residence_contry",
     *      description="1 => Afghanistan, 2 => Afrique du Sud",
     *      example="1"
     * )
     *
     * @var string
     */
    public $residence_contry;

     /**
     * @OA\Property(
     *      title="citizenship",
     *      description="1 => Afghanistan, 2 => Afrique du Sud",
     *      example="1"
     * )
     *
     * @var string
     */
    public $citizenship;

     /**
     * @OA\Property(
     *      title="email",
     *      example="test2@gmail.com"
     * )
     *
     * @var string
     */
    public $email;


    /**
     * @OA\Property(
     *      title="password",
     *      description="User password",
     *      format="password",
     *      example="password123@P"
     * )
     *
     * @var string
     */
    public $password;

      /**
     * @OA\Property(
     *      title="password",
     *      description="User password_confirmation",
     *      format="password",
     *      example="password123@P"
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
