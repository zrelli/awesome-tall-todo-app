<?php
namespace Database\Seeders;
use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach (range(1, 20) as $index) {
            $randomTodoId =  fake()->numberBetween(1, 30);
            $todo = Todo::where('id', $randomTodoId)->first();
            do {
                $randomSubscriber = fake()->numberBetween(1, 100);
            } while ($randomSubscriber == $todo->user_id || $randomSubscriber == $todo->subscriber_id);
            // subscriber shouldn't be todo owner or already subscribed
            DB::table('todo_subscriptions')->insert([
                'subscriber_id' => $randomSubscriber,
                'todo_id' => $todo->id,
            ]);
        }
    }
}
