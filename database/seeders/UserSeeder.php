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
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar' => null,
        ]);
        $admin->assignRole('admin');

        $admin = User::factory()->create([
            'name' => 'marketing',
            'email' => 'marketing@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar'=> null,
        ]);
        $admin->assignRole('marketing');

        $admin = User::factory()->create([
            'name' => 'public_relations',
            'email' => 'publicRelations@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar'=> null,
        ]);
        $admin->assignRole('public_relations');

        $admin = User::factory()->create([
            'name' => 'finance',
            'email' => 'finance@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar'=> null,
        ]);
        $admin->assignRole('finance');

        $admin = User::factory()->create([
            'name' => 'lecturer',
            'email' => 'lecturer@gmail.com',
            'password' => bcrypt('12345678'),
            'avatar'=> null,
        ]);
        $admin->assignRole('lecturer');
    }
}
