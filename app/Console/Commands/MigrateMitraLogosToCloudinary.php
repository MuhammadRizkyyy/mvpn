<?php

namespace App\Console\Commands;

use App\Models\Mitra;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Console\Command;

class MigrateMitraLogosToCloudinary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-mitra-logos-to-cloudinary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload mitra logos still pointing at local assets/img files to Cloudinary';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $mitras = Mitra::where('logo', 'like', 'assets/%')->get();

        if ($mitras->isEmpty()) {
            $this->info('No legacy local mitra logos to migrate.');

            return self::SUCCESS;
        }

        $this->withProgressBar($mitras, function (Mitra $mitra) {
            $path = public_path($mitra->logo);

            if (! is_file($path)) {
                $this->newLine();
                $this->warn("Skipped id={$mitra->id}: file not found at {$path}");

                return;
            }

            $uploaded = Cloudinary::uploadApi()->upload($path, ['folder' => 'mitra']);

            $mitra->update([
                'logo' => $uploaded['secure_url'],
                'logo_public_id' => $uploaded['public_id'],
            ]);
        });

        $this->newLine(2);
        $this->info('Done.');

        return self::SUCCESS;
    }
}
