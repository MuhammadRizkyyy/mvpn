<?php

namespace App\Console\Commands;

use App\Models\Partnership;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Console\Command;

class MigratePartnershipFilesToCloudinary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-partnership-files-to-cloudinary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload partnership proposal files still stored on the local disk to Cloudinary';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $partnerships = Partnership::whereNotNull('proposal_file')
            ->where('proposal_file', 'not like', 'http://%')
            ->where('proposal_file', 'not like', 'https://%')
            ->get();

        if ($partnerships->isEmpty()) {
            $this->info('No legacy local partnership files to migrate.');

            return self::SUCCESS;
        }

        $this->withProgressBar($partnerships, function (Partnership $partnership) {
            $path = storage_path('app/public/' . $partnership->proposal_file);

            if (! is_file($path)) {
                $this->newLine();
                $this->warn("Skipped id={$partnership->id}: file not found at {$path}");

                return;
            }

            $uploaded = Cloudinary::uploadApi()->upload($path, [
                'folder' => 'partnership_files',
                'resource_type' => 'auto',
                'use_filename' => true,
                'unique_filename' => true,
            ]);

            $partnership->update(['proposal_file' => $uploaded['secure_url']]);
        });

        $this->newLine(2);
        $this->info('Done.');

        return self::SUCCESS;
    }
}
