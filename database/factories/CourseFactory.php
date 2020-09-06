<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    $category_id = Category::all()->pluck('id')->toArray();
    $random_key = array_rand($category_id);
    $name = $faker->unique()->sentence;
    return [
        'name' => $name,
        'description' => $faker->text,
        'slug' => $name,
        'category_id' => $category_id[$random_key],
    ];
});
