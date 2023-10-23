<?php
namespace Database\Seeders;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (range(1, 30) as $index) {
            $createdAt = Carbon::now()
                ->subDays(fake()->numberBetween(1, 30))
                ->subHours(fake()->numberBetween(1, 24));
            Todo::create([
                'title' => fake()->sentence,
                'content' => fake()->paragraph,
                'is_completed' => fake()->boolean,
                // 'user_id' => fake()->numberBetween(1, 2),//test
                'user_id' => fake()->numberBetween(1, 30),
                'created_at' => $createdAt
            ]);
        }
    }
}
