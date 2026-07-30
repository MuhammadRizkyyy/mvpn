<?php

namespace Database\Seeders;

use App\Models\Pengurus;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    /**
     * Migrates the members that used to be hardcoded on the landing page into
     * the pengurus table, uploading their local photos to Cloudinary.
     */
    public function run(): void
    {
        $members = [
            ['section' => 'bod', 'name' => 'Indra A. Oktariawan', 'position' => 'Presiden', 'file' => 'pres1.png', 'instagram_url' => 'https://www.instagram.com/oktariawanindra?igsh=MWNkZG1kZGE1NHZrZg==', 'order' => 0],
            ['section' => 'bod', 'name' => 'Ani Yuliani', 'position' => 'Wakil Presiden', 'file' => 'wapres.png', 'instagram_url' => 'https://www.instagram.com/aniyuliani2020?igsh=MWRwMWR4emJqY3E0aQ==', 'order' => 1],

            ['section' => 'sekretaris', 'name' => 'Putri Wardhany', 'position' => 'Sekretaris', 'file' => 'sekre1.png', 'instagram_url' => 'https://www.instagram.com/__putriwardha?igsh=MXh6NThjZWxha3BhaA==', 'order' => 0],
            ['section' => 'sekretaris', 'name' => 'Maria C. Maharani', 'position' => 'Wakil Sekretaris', 'file' => 'sekre2_v2.png', 'instagram_url' => 'https://www.instagram.com/raanisti?igsh=MWEyMmN0N3JuOXY0Zg==', 'order' => 1],

            ['section' => 'ekonomi', 'name' => 'Susanty', 'position' => 'Direktorat', 'file' => 'direktorat.png', 'instagram_url' => null, 'order' => 0],
            ['section' => 'ekonomi', 'name' => 'Ajeng Fimara', 'position' => 'Wakil Direktorat', 'file' => 'wakildirektorat.png', 'instagram_url' => 'https://www.instagram.com/ajengfsbtr_?igsh=Y3oxaThqZWJ3dnJ1', 'order' => 1],

            ['section' => 'internasional', 'name' => 'DR.(C). Ramdani Murdiana', 'position' => 'Hubungan Internasional ASEAN', 'file' => 'hi asean.jpeg', 'instagram_url' => 'https://www.instagram.com/walikutay?igsh=dDB0YTNvd3A3cWJh', 'order' => 0],
            ['section' => 'internasional', 'name' => 'Budi Suranto', 'position' => 'Hubungan Internasional Timur Tengah', 'file' => 'hi tim.png', 'instagram_url' => null, 'order' => 1],

            ['section' => 'itdev', 'name' => 'Fardin Muhammad Azis', 'position' => 'Frontend Web Developer', 'file' => 'it.jpeg', 'instagram_url' => 'https://www.instagram.com/swsevrydy_/', 'order' => 0],
        ];

        foreach ($members as $member) {
            if (Pengurus::where('section', $member['section'])->where('name', $member['name'])->exists()) {
                continue;
            }

            $path = public_path('assets/img/'.$member['file']);

            if (! is_file($path)) {
                $this->command?->warn("Skipped {$member['name']}: image not found at {$path}");

                continue;
            }

            $uploaded = Cloudinary::uploadApi()->upload($path, ['folder' => 'pengurus']);

            Pengurus::create([
                'section' => $member['section'],
                'name' => $member['name'],
                'position' => $member['position'],
                'photo' => $uploaded['secure_url'],
                'photo_public_id' => $uploaded['public_id'],
                'instagram_url' => $member['instagram_url'],
                'order' => $member['order'],
            ]);
        }
    }
}
