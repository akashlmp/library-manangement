<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $categories = BookCategory::pluck('id')->toArray();
        $batchSize = 1000;
        $totalRecords = 10000000;
        ini_set('memory_limit', '1024M');


        for ($i = 0; $i < $totalRecords; $i += $batchSize) {
            $books = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $books[] = [
                    'name' => $faker->sentence(3),
                    'author' => $faker->name,
                    'seller_id' => 1,
                    'category_id' => $faker->randomElement($categories),
                    'price' => $faker->randomFloat(2, 10, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('books')->insert($books);
        }
    }
}
