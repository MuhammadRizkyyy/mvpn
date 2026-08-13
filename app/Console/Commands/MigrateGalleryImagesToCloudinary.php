<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Console\Command;

class MigrateGalleryImagesToCloudinary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-gallery-images-to-cloudinary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload gallery photos still stored on local disk (storage/app/public) to Cloudinary';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $galleries = Gallery::where('image', 'not like', 'http%')->get();

        if ($galleries->isEmpty()) {
            $this->info('No legacy local gallery images to migrate.');

            return self::SUCCESS;
        }

        $this->withProgressBar($galleries, function (Gallery $gallery) {
            $path = storage_path('app/public/' . $gallery->image);

            if (! is_file($path)) {
                $this->newLine();
                $this->warn("Skipped id={$gallery->id}: file not found at {$path}");

                return;
            }

            $uploaded = Cloudinary::uploadApi()->upload($path, ['folder' => 'gallery']);

            $gallery->update([
                'image' => $uploaded['secure_url'],
                'image_public_id' => $uploaded['public_id'],
            ]);
        });

        $this->newLine(2);
        $this->info('Done.');

        return self::SUCCESS;
    }
}
