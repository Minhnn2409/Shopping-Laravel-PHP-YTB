<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StoreImageTrait
{
    public function StoreTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileUploadName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('/public/' . $folderName . '/' . auth()->id(), $fileUploadName);
            $dataUpload = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUpload;
        }
        return null;
    }

    public function StoreTraitUploadMultiple($file, $folderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileUploadName = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('/public/' . $folderName . '/' . auth()->id(), $fileUploadName);
        $dataUpload = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUpload;
    }
}
