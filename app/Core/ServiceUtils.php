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

    /**
     * Concatenates words with an underscore and makes the result lowercase.
     *
     * @param string ...$words The words to concatenate.
     * @return string The concatenated and lowercase result.
     * / Example usage of the function  concatenateAndMakeLowercase("First", "Second", "Third");
     */
    static function concatenateAndMakeLowercase(...$words){
        $word = implode("_",$words);
        return strtolower($word);
    }
}
