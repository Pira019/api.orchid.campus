<?php
namespace App\Core;

use Illuminate\Support\Facades\Storage;

class ServiceUtils{
    static function ucfirst_lower($string){
        /*
        Sets the first letter of a string to uppercase and the other letters to lowercase.
        */
       return ucfirst(strtolower($string));
    }

    // ex: pires fame return pires-family
    public function replaceSpaceToHyphen($input)
    {

        $slug = str_replace(' ', '-', $input);
        // Make the string lowercase
        $slug = strtolower($slug);

        return $slug;
    }

    public function storeImage($file,$imageName,$disk="public")
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $imageName.".$extension";
        Storage::disk($disk)->put($filename,$file->getContent());
        return Storage::disk($disk)->url($filename);
    }
}
