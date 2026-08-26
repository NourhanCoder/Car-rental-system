<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
 * Upload a new image and delete the old one if it exists.
 */

    public function uploadImage(UploadedFile $file, string $folder, ?string $oldImagePath = null): string
    {
        /// 1. Delete the old image if provided
        if ($oldImagePath) {
            $this->deleteImage($oldImagePath);
        }

        // 2. Upload the new image and return the path
        return $file->store($folder, 'public');
    }

    /**
     * Delete an image from storage if it exists.
     */
    public function deleteImage(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        
        $cleanPath = str_replace(['/storage/', 'storage/', 'public/'], '', $path);

        if (Storage::disk('public')->exists($cleanPath)) {
            return Storage::disk('public')->delete($cleanPath);
        }

        return false;
    }
}