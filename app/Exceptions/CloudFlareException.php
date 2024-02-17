<?php

namespace App\Exceptions;

use Exception;

class CloudFlareException extends Exception
{
    public function rendrer($request)
    {
        return response()->json(
            [
                'error' => [
                    'message' => $this->getMessage()
                ]
                ], $this->getCode()
            );
    }
}
