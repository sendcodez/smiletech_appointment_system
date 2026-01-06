<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'middlename' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => '1',
            'usertype' => '1'
        ]);
        DB::table('users')->insert([
            'username' => 'dentist',
            'firstname' => 'Dentist',
            'middlename' => 'Dentist',
            'lastname' => 'Dentist',
            'email' => 'dentist@gmail.com',
            'password' => Hash::make('dentist123'),
            'status' => '1',
            'usertype' => '2'
        ]);
        DB::table('users')->insert([
            'username' => 'patient',
            'firstname' => 'Patient',
            'middlename' => 'Patient',
            'lastname' => 'Patient',
            'email' => 'patient@gmail.com',
            'password' => Hash::make('patient123'),
            'status' => '1',
            'usertype' => '3'
        ]);
        DB::table('websites')->insert([
            'logo' => 'smiletech_logo.png',
            'business_name' => 'Smiletech',
            'tagline' => 'Take The Best Quality Dental Treatment',
            'address' => 'Lantic, Carmona City, Cavite',
            'contact_number' => '0909-111-2222',
            'email' => 'smiletech@gmail.com',
            'store_close' => '"[\"saturday\",\"sunday\"]"',
            'store_hour_start' => '08:00',
            'store_hour_end' => '16:00',
            'customer_morning' => '5',
            'customer_afternoon' => '4',
            'about' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet',
        ]);
    }
}