<?php
namespace App\Repository;

use Illuminate\Support\Facades\Http;

class CountryFlagRepository
{

    public function __construct()
    {}
    public static function getSvgFlagUrlByCountryShortName($countryShortName)
    {

        $imgSvg = Http::asForm()->get(env("REST_COUNTRY_CODE_URL") . $countryShortName);

        if ($imgSvg->failed()) {
            return null;
        }

        return $imgSvg->json()[0]["flags"]["svg"];

    }

}
