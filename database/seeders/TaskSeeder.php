<?php
namespace Database\Seeders;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //first 100 todo should have many tasks
        foreach (range(1, 1000) as $index) {
            $createdAt = Carbon::now()
                ->subDays(fake()->numberBetween(1, 30))
                ->subHours(fake()->numberBetween(1, 24));
            Task::create([
                'content' => fake()->paragraph,
                'is_completed' => fake()->boolean,
                'todo_id' => fake()->numberBetween(1, 10),
                'created_at' => $createdAt
            ]);
        }
        foreach (range(1, 1000) as $index) {
            $createdAt = Carbon::now()
                ->subDays(fake()->numberBetween(1, 30))
                ->subHours(fake()->numberBetween(1, 24));
            Task::create([
                'content' => fake()->paragraph,
                'is_completed' => fake()->boolean,
                'todo_id' => fake()->numberBetween(1, 100),
                'created_at' => $createdAt
            ]);
        }
    }
}
