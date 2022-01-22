<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getNews(?int $id = null): array
    {
        $data = [];
        $faker = Factory::create();

        if (!is_null($id)) {
            return [
                'id' => $id,
                'title' => $faker->jobTitle(),
                'description' => $faker->text(100),
                'author' => $faker->userName(),
                'created_at' => now('Europe/Moscow')
            ];
        }

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'id' => $i,
                'title' => $faker->jobTitle(),
                'description' => $faker->text(100),
                'author' => $faker->userName(),
                'created_at' => now('Europe/Moscow')
            ];
        }

        return $data;
    }

    public function getCategories(): array
    {
        $data = [];
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'id' => $i,
                'title' => $faker->city()
            ];
        }

        return $data;
    }
}
