<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $title = $faker->sentence(5);
            $data[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'author' => $faker->userName(),
                'status' => ['draft', 'active', 'blocked'][rand(0, 2)],
                'description' => $faker->text(100),
                'source_id' => rand(1, 10)
            ];
        }

        return $data;
    }
}
