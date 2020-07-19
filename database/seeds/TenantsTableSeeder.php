<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'cnpj' => '313215213213',
            'name' => 'JFSystens',
            'url' => 'jfsystens',
            'email' => 'jardel@mail.com'
        ]);
    }
}
