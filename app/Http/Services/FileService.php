<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;

class FileService
{
    public function uppload($file, $directory): string
    {
        $fileName = uniqid('logo_') . '.' . $file->getClientOriginalExtension();

        if (!file_exists($directory)) {
            // If not, create it
            File::makeDirectory($directory, 0777, true);
        }

        $file->move(public_path($directory), $fileName);

        return "$directory/" . $fileName;
    }
}