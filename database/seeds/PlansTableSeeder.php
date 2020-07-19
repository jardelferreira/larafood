<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => "Businers",
            'description' => 'Plano Empresarial',
            'price' => 499.99,
            'url' => 'businers'
        ]);
    }
}
