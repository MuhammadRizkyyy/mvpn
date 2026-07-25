<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    public function run(): void
    {
        if (Mitra::count() > 0) {
            return;
        }

        $categories = [
            'media' => ['MEDIA1.png', 'media2.jpeg', 'media3.jpeg', 'med.png'],
            'community' => ['com1-image.jpeg', 'com2-image.jpeg', 'com3-image.jpeg', 'com4-image.jpeg', 'com5-image.jpeg', 'com6-image.png'],
            'government' => ['gov1.jpeg', 'gov2.jpeg', 'gov3.png', 'gov4.jpeg', 'gov5.jpeg', 'gov6.jpeg', 'gov7.jpeg', 'gov8.jpeg', 'gov9.png'],
            'hospitality_campus' => ['hc1.jpeg', 'hc5.jpeg'],
            'hotel' => ['hotel1.jpeg', 'hotel2.jpeg', 'hotel3.jpeg', 'hotel4.jpeg', 'hotel5.jpeg'],
            'brand' => ['brand1.jpeg', 'brand2.jpeg', 'brand3.jpeg', 'brand4.jpeg', 'brand5.jpeg', 'brand6.jpeg', 'brand7.jpeg', 'brand8.jpeg', 'brand9.jpeg', 'brand10.jpeg', 'brand11.jpeg', 'brand12.jpeg', 'brand13.jpeg', 'brand14.jpeg', 'brand15.jpeg', 'brand16.jpeg', 'brand17.png', 'brand18.png', 'brand19.png', 'brand20.png', 'brand21.png', 'brand22.jpeg', 'brand23.png', 'brand24.png', 'brand25.png', 'brand26.jpeg'],
            'law' => ['law1.jpeg', 'law2.jpeg'],
            'ip_trade' => ['ip1.png', 'ip2.png', 'ip3.jpeg', 'ip4.jpeg', 'ip5.png', 'ip6.jpeg', 'ip7.jpeg'],
        ];

        foreach ($categories as $category => $images) {
            foreach ($images as $order => $image) {
                Mitra::create([
                    'category' => $category,
                    'logo' => 'assets/img/' . $image,
                    'order' => $order,
                ]);
            }
        }
    }
}
