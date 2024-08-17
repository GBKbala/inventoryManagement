<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        if (User::where('email', 'superadmin@example.com')->doesntExist()) {
        
            $user = User::create([
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'username' => 'SuperAdmin',
                'dob' =>'1999-06-04',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'userRole' => 0,
                'mobile' => '1234567899',
                'address' => 'admin address',
                'state' => 'Tamil Nadu',
                'city' => 'Chennai',
                'pincode' => '600018'
            ]);
        }
    }
}
