<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@skillbantuin.com'],
            [
                'name'      => 'Super Admin',
                'username'  => 'admin',
                'email'     => 'admin@skillbantuin.com',
                'password'  => Hash::make('admin12345'),
                'role'      => 'admin',
                'is_active' => true,
                'phone'     => '08123456789',
            ]
        );

        $this->command->info('Admin user created: admin@skillbantuin.com / admin12345');
    }
}
