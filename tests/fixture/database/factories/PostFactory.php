<?php

$factory->define(Post::class, function (Faker\Generator $faker) {
    return ['title' => $faker->sentence];
});
