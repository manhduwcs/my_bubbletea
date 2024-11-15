<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'Manh Nguyen',
                'phone' => '0987654321',
                'email' => 'admin@gmail.com',
                'address' => '192 Minh Khai',
                'password' => Hash::make('makima1'),
                'role' => 'Admin',
                'account_status' => 'Active',
                'avatar' => 'images/users/users_avatar_1.png',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Johnson Baby',
                'phone' => '0999999999',
                'email' => 'johnsonbaby@gmail.com',
                'address' => '19 Nguyen Trai',
                'password' => Hash::make('makima1'),
                'role' => 'Admin',
                'account_status' => 'Active',
                'avatar' => 'images/users/users_avatar_3.png',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hoang Long',
                'phone' => '0921657788',
                'email' => 'hglong2@gmail.com',
                'address' => '1012 De La Thanh',
                'password' => Hash::make('makima1'),
                'role' => 'User',
                'account_status' => 'Active',
                'avatar' => 'images/users/users_avatar_6.png',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
