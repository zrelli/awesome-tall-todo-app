<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (range(1, 100) as $index) {

            $createdAt = Carbon::now()
            ->subDays(fake()->numberBetween(1, 30))
            ->subHours(fake()->numberBetween(1, 24));

            User::create([
                'name' => fake()->name,
                'email' => fake()->unique()->safeEmail,
                'password' => bcrypt('123456'),
                'created_at' => $createdAt
            ]);
        }
    }
}
