<?php

namespace Tests\Feature\Customer\Controllers;

use Carbon\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Mockery\MockInterface;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_invalid_data() : void
    {
        $data = [
            'name' => fake()->lastName(),
            'first_name' => fake()->lastName(),
            'sex' => 'M',
            'phone' => fake()->phoneNumber(),
            'birth_date' =>fake()->date(), // Subtract 15 years and set the time to the beginning of the day
            'residence_contry' => 1,
            'citizenship' => 2,
            'email' => fake()->email(),
            'password_confirmation' => "121212",
            'password' => "55559",
        ];

        $response = $this->post('/orchid-campus/register',$data);

        $response->assertStatus(404);
    }
}
