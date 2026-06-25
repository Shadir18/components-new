<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Seller;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Default',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'), 
        ]);

        Seller::create([
            'user_id' => $user->id,
            'name' => $user->first_name,
        ]);
    }
}
