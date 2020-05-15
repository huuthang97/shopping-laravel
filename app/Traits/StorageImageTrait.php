<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait {
    public function storageTraitUpload($request, $fileName, $folder ) {

        if ($request->hasFile($fileName)) {
            $user_id = Auth()->user()->id;
            $file = $request->file($fileName);
            $originalName = $file->getClientOriginalName();
            $extension = $file->extension();
            $fileNameHash = Str::random(20) . '.' . $extension;
            $path = $request->file($fileName)->storeAs(
                'public/' . $folder . '/' . $user_id, $fileNameHash
            );
            $dataUploadTrait = [
                'file_name' => $originalName,
                'path' => Storage::url($path)
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function storageTraitUploadMulti($file, $folder) {
        $user_id = Auth()->user()->id;
        $originalName = $file->getClientOriginalName();
        $extension = $file->extension();
        $fileNameHash = Str::random(20) . '.' . $extension;
        $path = $file->storeAs(
            'public/' . $folder . '/' . $user_id, $fileNameHash
        );
        $dataUploadTraitMulti = [
            'file_name' => $originalName,
            'path' => Storage::url($path)
        ];
        return $dataUploadTraitMulti;
    }

}