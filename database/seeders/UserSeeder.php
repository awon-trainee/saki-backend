<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'mazen',
            'email' => 'mazen@awontech.sa',
            'password' => bcrypt('1'),
            'phone' => '966533363857',
            'type' => User::ADMIN,
        ]);

        $user->assignRole(User::ROLE_ADMIN);
    }
}
