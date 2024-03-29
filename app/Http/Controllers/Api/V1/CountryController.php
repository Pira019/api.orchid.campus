<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\CountryRepository;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(public CountryRepository $countryRepository){}
    public function getList(){
        return $this->countryRepository->getCoutryList(["id","name"]);
    }

    public function getCitiesByCountry($idCountry,Request $request){
        $request->merge(['country_id' => $request->route('idCountry')]);
        $request->validate([
            'country_id' =>
                'required|integer',
        ]);
        return $this->countryRepository->getCitiesByCountryId($idCountry);
    }
}
