<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Todo::factory(10)->for($user)->create();
    }
}
