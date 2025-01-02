<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUs; 

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'heading' => 'Welcome to Our Club',
            'description' => 'Our club is dedicated to fostering a community of like-minded individuals who share a passion for excellence and camaraderie.',
            'image' => 'assets/images/about-us.jpg',
        ]);
    }
}
