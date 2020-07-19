<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $tenant->users()->create([
            'tenant_id' => 1,
            'name' => "Jardel Ferreira",
            'email' => "jardel@mail.com",
            'password' => bcrypt('jardel1987')
        ]);
    }
}
