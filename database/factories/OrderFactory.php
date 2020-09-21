<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(Tenant::class),
        'identify' => Str::uuid(),
        'total' => 80.00,
        'status' => 'open'
    ];
});
