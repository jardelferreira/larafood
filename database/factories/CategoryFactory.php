<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        //'uuid' => Str::uuid(),
        'name' => $faker->unique()->name
    ];
});
