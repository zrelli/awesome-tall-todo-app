<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EmailProviderSeeder::class,
            UserSeeder::class,
            TodoSeeder::class,
            TaskSeeder::class,
            SubscriptionSeeder::class,
        ]);
    }
}
