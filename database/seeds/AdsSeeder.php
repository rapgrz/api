<?php

use Illuminate\Database\Seeder;
use App\Advertisement;
use Illuminate\Support\Str;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $list = [];
      $faker = \Faker\Factory::create();

      for($i = 0; $i < 15; $i++){
        $item = [
            'title' => $faker->sentence,
            'content' => $faker->paragraph,
            'views' => $faker->numberBetween(0, 50),
            "created_at" =>  Carbon\Carbon::now(),
            "updated_at" => Carbon\Carbon::now()
          ];
        array_push($list, $item);
      }

      Advertisement::insert($list);
    }
}
