<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function uppload($file, $directory): string
    {
        // Генерация уникального имени файла
        $fileName = uniqid('img_') . '.' . $file->getClientOriginalExtension();
    
        // Создание соответствующих подпапок, если они не существуют
        Storage::makeDirectory($directory);

        // Сохранение файла по указанному пути
        $path = $file->storeAs($directory, $fileName);

        // Путь к сохраненному файлу
        return Storage::url($path);
    }
}