<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->text(19),
        'desc' => $faker->text(40),
        'category_id' => $faker->numberBetween(1, 5),
        'priority' => $faker->randomElement(array('Low', 'Medium', 'High')),
        'completed' => $faker->boolean(35),
        'date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
        'user_id' => $faker->numberBetween(1, 2)
    ];
});
