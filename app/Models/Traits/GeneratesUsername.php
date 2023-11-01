<?php
namespace App\Models\Traits;

trait GeneratesUsername
{
   public static function generatesUsername($customerName,$customerId){
        $timePart = date('Hs'); // Include seconds for uniqueness
        return  substr(strtoupper($customerName), 0, 2) . $timePart.$customerId;
    }
}
