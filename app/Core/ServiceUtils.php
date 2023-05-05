<?php
namespace App\Core;
class ServiceUtils{
    static function ucfirst_lower($string){
        /*
        Sets the first letter of a string to uppercase and the other letters to lowercase.
        */
       return ucfirst(strtolower($string));
    }
}
