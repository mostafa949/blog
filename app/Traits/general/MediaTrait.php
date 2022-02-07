<?php

namespace App\Traits\general;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait MediaTrait
{

    public function uploads($file, $path, $name = null): string
    {
            $fileName = uniqid() . '-' . str_replace(' ', '-', $name) . '.' . $file->extension();
            Storage::disk('public')->put($path . $fileName, File::get($file));
//            $file_name = $file->getClientOriginalName();
//            $file_type = $file->getClientOriginalExtension();
//            $filePath = 'storage/' . $path . $fileName;

            return $fileName;
    }

    public function updateUpload($file, $fileName, $path)
    {
            Storage::disk('public')->put($path . $fileName, File::get($file));
            return $fileName;
    }

    public function delete($path, $fileName)
    {
        Storage::delete('public/images/' . $path . $fileName);
    }


    public
    function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();

        if ($size > 0) {
            $size = (int)$size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}
