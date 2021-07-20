<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param   FormRequest  $request
     *
     * @param                $fileInputField
     * @param                $storagePath
     *
     * @return array|false|string
     */
    protected function saveImage(FormRequest $request, $fileInputField, $storagePath)
    {
        $imageFullPath = $request->file($fileInputField)->store($storagePath);

        $imageName = basename($imageFullPath);

        return $imageName;
    }
}
