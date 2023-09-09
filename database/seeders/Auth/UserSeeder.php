<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=User::create([
            'name'=>'admin',
            'email'=>'admin@example.com',
            'phone_number'=>'254712345678',
            'password'=>Hash::make('Password123!'),
            'status'=>'ACTIVE',
            'country_id'=>1
        ]);
        //assign admin role
        //get admin role
        $adminRole= Role::where('name','admin')->first();
        $admin->assignRole($adminRole);
        //create user
        $user=User::create([
            'name'=>'John Doe',
            'email'=>'johndoe@example.com',
            'phone_number'=>'254712345678',
            'password'=>Hash::make('Allow123!'),
            'status'=>'ACTIVE',
            'country_id'=>2
        ]);
        //get user role
        $userRole= Role::where('name','user')->first();
        //
        $user->assignRole($userRole);
    }
}
