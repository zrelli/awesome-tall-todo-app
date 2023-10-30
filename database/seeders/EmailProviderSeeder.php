<?php
namespace Database\Seeders;
use App\Models\EmailProvider;
use Illuminate\Database\Seeder;
class EmailProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $providers=['Mailhog','Mailcatcher'];
        foreach (range(0, 1) as $index) {
            EmailProvider::create([
                'name'=>$providers[$index],
                'content' => fake()->paragraph,
            ]);
        }
    }
}
