<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriesHasNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_has_news')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];

        for ($i = 0; $i < 150; $i++) {
            $data[] = [
                'category_id' => rand(1, 10),
                'news_id' => rand(1, 100),
            ];
        }

        return $data;
    }
}
