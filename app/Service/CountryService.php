<?php
namespace App\Service;

use App\Models\Country;
use App\Repository\CountryFlagRepository;

class CountryService {

    public static function addFlagSvgImgToCountry($idCountry){
        $countryShortName = Country::where('id', $idCountry)->value('short_name');
        $flagUrl = CountryFlagRepository::getSvgFlagUrlByCountryShortName($countryShortName);

        Country::where('id', $idCountry)->update(['flag_url' => $flagUrl]);
    }

}
