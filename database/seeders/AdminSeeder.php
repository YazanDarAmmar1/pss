<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = env("ADMIN_EMAIL");
        $admin->password = Hash::make(env("ADMIN_PASSWORD"));
        $admin->save();
    }
}
