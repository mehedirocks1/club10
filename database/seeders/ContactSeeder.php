<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact; 

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'full_name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'subject' => 'General Inquiry',
            'message' => 'I would like to know more about your club and membership options.',
        ]);
    }
}
