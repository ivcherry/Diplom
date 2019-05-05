<?php

namespace App\BusinessLogic;


use Illuminate\Support\Facades\Storage;

class FileManager {

    public function saveFileInStorage($path, $file){
        $filePath = Storage::putFile($path, $file);

        $temp = explode("/", $filePath);
        $temp[0] = "";

        return implode('/', $temp);

    }
}