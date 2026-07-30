<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;

class CloudinaryImageService
{
    /**
     * Upload a file to Cloudinary and return ['url' => ..., 'public_id' => ...].
     *
     * $resourceType: 'image' for photos/logos, 'auto' for documents (pdf/doc/docx) so
     * Cloudinary categorizes them correctly and serves them from a public URL.
     */
    public function upload(UploadedFile $file, string $folder, string $resourceType = 'image'): array
    {
        $result = Cloudinary::uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'resource_type' => $resourceType,
            'use_filename' => $resourceType !== 'image',
            'unique_filename' => true,
        ]);

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
    }

    public function delete(?string $publicId, string $resourceType = 'image'): void
    {
        if (! $publicId) {
            return;
        }

        Cloudinary::uploadApi()->destroy($publicId, ['resource_type' => $resourceType]);
    }
}
