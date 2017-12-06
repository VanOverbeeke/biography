<?php

use Illuminate\Database\Seeder;

use App\Http\Models\Genus;

class GenusSeeder extends Seeder
{
    public function run()
    {
        Genus::firstOrCreate([
            'id' => 1,
            'name' => 'Crocodylus'
        ]);
        Genus::firstOrCreate([
            'id' => 2,
            'name' => 'Panthera'
        ]);
        Genus::firstOrCreate([
            'id' => 3,
            'name' => 'Homo'
        ]);
        Genus::firstOrCreate([
            'id' => 4,
            'name' => 'Equus'
        ]);
        Genus::firstOrCreate([
            'id' => 5,
            'name' => 'Canis'
        ]);
        Genus::firstOrCreate([
            'id' => 6,
            'name' => 'Savalia'
        ]);
        Genus::firstOrCreate([
            'id' => 7,
            'name' => 'Sequoiadendron'
        ]);
    }
}
