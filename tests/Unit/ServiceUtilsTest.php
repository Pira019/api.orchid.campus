<?php

namespace Tests\Unit;

use App\Core\ServiceUtils;
use PHPUnit\Framework\TestCase;

class ServiceUtilsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_word_and_return_firdt_capital()
    {
        $givenInputWord ="namepersonne";
        $expected_return ="Namepersonne";

        $this->assertEquals($expected_return,ServiceUtils::ucfirst_lower($givenInputWord));
    }

    public function test_if_input_is_number()
    {
        $givenInputWord =1;
        $expected_return =1;

        $this->assertEquals($expected_return,ServiceUtils::ucfirst_lower($givenInputWord));
    }

    public function test_if_input_is_empty()
    {
        $givenInputWord ='';

        $this->assertEmpty(ServiceUtils::ucfirst_lower($givenInputWord));
    }





    /*
    test if integer
    is string if
    return result
    */
}
