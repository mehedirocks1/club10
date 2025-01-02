<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery; 

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['image' => 'assets/images/gallery/1.jpg', 'description' => 'A beautiful sunrise over the club grounds.'],
            ['image' => 'assets/images/gallery/2.jpg', 'description' => 'Our members enjoying a sunny day.'],
            ['image' => 'assets/images/gallery/3.jpg', 'description' => 'A memorable event at the clubhouse.'],
        ];

        // Insert each image record into the database
        foreach ($images as $image) {
            Gallery::create($image);
        }
    }
}
