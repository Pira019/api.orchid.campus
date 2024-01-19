<?php
namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;

trait Utils
{
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
        $filename = $this->replaceSpaceToHyphen($imageName).$extension;
        Storage::disk($disk)->put($filename,$file->getContent());
        return Storage::disk($disk)->url($filename);
    }
}
