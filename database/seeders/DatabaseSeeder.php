<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
 /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(AboutUsSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(TeamSeeder::class);





        // Seed Admin User
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'bangla_name' => 'অ্যাডমিন',
            'photo' => null, // Optional: Add a photo path or leave null
            'email' => 'admin@example.com',
            'mobile_number' => '0123456780',
            'dob' => '1980-01-01',
            'nid' => '9876543210123456',
            'gender' => 'Male',
            'blood_group' => 'A+',
            'education' => 'Master\'s Degree',
            'profession' => 'Manager',
            'skills' => 'Leadership, Management',
            'country' => 'Bangladesh',
            'division' => 'Dhaka',
            'district' => 'Dhaka',
            'thana' => 'Banani',
            'address' => '456, Banani, Dhaka, Bangladesh',
            'membership_type' => 'Admin',
            'registration_fee' => '0', // Example fee for admin
            'terms_accepted' => true,
            'password' => bcrypt('admin123'), // Secure password
            'role_id' => 1, // Admin Role
            'status' => 1, // Active
        ]);

        // Seed Staff User
        User::factory()->create([
            'first_name' => 'Staff',
            'last_name' => 'User',
            'bangla_name' => 'স্টাফ',
            'photo' => null,
            'email' => 'staff@example.com',
            'mobile_number' => '0123456781',
            'dob' => '1995-01-01',
            'nid' => '9876543211123456',
            'gender' => 'Female',
            'blood_group' => 'B+',
            'education' => 'Bachelor\'s Degree',
            'profession' => 'Support Staff',
            'skills' => 'Organization, Coordination',
            'country' => 'Bangladesh',
            'division' => 'Chattogram',
            'district' => 'Chattogram',
            'thana' => 'Halishahar',
            'address' => '123, Halishahar, Chattogram, Bangladesh',
            'membership_type' => 'Staff',
            'registration_fee' => '1000',
            'terms_accepted' => true,
            'password' => bcrypt('staff123'),
            'role_id' => 2, // Staff Role
            'status' => 1, // Active
        ]);

        // Seed Regular User
        User::factory()->create([
            'first_name' => 'Regular',
            'last_name' => 'User',
            'bangla_name' => 'নিয়মিত',
            'photo' => null,
            'email' => 'user@example.com',
            'mobile_number' => '0123456782',
            'dob' => '2000-01-01',
            'nid' => '9876543212123456',
            'gender' => 'Other',
            'blood_group' => 'O-',
            'education' => 'High School',
            'profession' => 'Student',
            'skills' => 'Learning, Problem-solving',
            'country' => 'Bangladesh',
            'division' => 'Khulna',
            'district' => 'Khulna',
            'thana' => 'Khalishpur',
            'address' => '456, Khalishpur, Khulna, Bangladesh',
            'membership_type' => 'Standard',
            'registration_fee' => '500',
            'terms_accepted' => true,
            'password' => bcrypt('user123'),
            'role_id' => 3, // User Role
            'status' => 1, // Active
        ]);
    }
}
