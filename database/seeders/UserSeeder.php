<?php
namespace Database\Seeders;
use App\Models\User;
use Carbon\Carbon;
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
            $name = $index == 1 ? "test" : fake()->name;
            $email = $index == 1 ? "test@test.com" : fake()->unique()->safeEmail;
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt('12345678'),
                'avatar' =>            fake()->imageUrl(100, 100, 'people'),
                'created_at' => $createdAt
            ]);
        }
    }
}
