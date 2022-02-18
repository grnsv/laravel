<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;

class UploadService
{
    public function saveFile(UploadedFile $file): string
    {
        $filename = $file->storeAs('news', $file->hashName(), 'public');
        if (!$filename) {
            throw new \Exception("File wasn't upload");
        }
        return $filename;
    }
}
