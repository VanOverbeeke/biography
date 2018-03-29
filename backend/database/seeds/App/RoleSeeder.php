<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::firstOrCreate([
            'id' => 1,
            'name' => 'Owner',
        ]);
        Role::firstOrCreate([
            'id' => 2,
            'name' => 'Administrator',
        ]);
        Role::firstOrCreate([
            'id' => 3,
            'name' => 'User',
        ]);

    }
}
