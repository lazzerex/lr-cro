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
        User::factory()->create([
            'id' => 16,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@lr-cro.test',
        ]);

        User::factory()->create([
            'name' => 'Editor',
            'username' => 'editor',
            'email' => 'editor@lr-cro.test',
        ]);

        User::factory()->create([
            'name' => 'Author',
            'username' => 'author',
            'email' => 'author@lr-cro.test',
        ]);
    }
}
