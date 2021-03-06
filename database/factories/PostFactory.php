<?php

use Faker\Generator as Faker;



$factory->define(App\Post::class, function (Faker $faker) {

    return [
        'title' => $title = $faker->title,
        'title_seo' => str_seo($title . rand(0, 1000)),
        'introduce' => $faker->name,
        'content' => $faker->text,
        'author' => $faker->name,
        'status' => 'show',
        'user_id' => 1,
        'category_id' => 1,
        'slide' => rand(0,1) == 0 ? 'hide' : 'show'
    ];
});
