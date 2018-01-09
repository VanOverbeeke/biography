<?php

use Illuminate\Database\Seeder;
use App\Models\Species;

class SpeciesSeeder extends Seeder
{
    public function run()
    {
        Species::firstOrCreate([
            'id' => 1,
            'name' => 'johnstoni',
            'genus_id' => 1,
            'wiki' => 'https://en.wikipedia.org/wiki/Freshwater_crocodile',
            'age' => 50,
            'size' => 4.0,
            'weight' => 100
        ]);
        Species::firstOrCreate([
            'id' => 2,
            'name' => 'niloticus',
            'genus_id' => 1,
            'wiki' => 'https://en.wikipedia.org/wiki/Nile_crocodile',
            'age' => 70,
            'size' => 6,
            'weight' => 1100
        ]);
        Species::firstOrCreate([
            'id' => 3,
            'name' => 'leo',
            'genus_id' => 2,
            'wiki' => 'https://en.wikipedia.org/wiki/Lion',
            'age' => 20,
            'size' => 1.20,
            'weight' => 190
        ]);
        Species::firstOrCreate([
            'id' => 4,
            'name' => 'uncia',
            'genus_id' => 2,
            'wiki' => 'https://en.wikipedia.org/wiki/Snow_leopard',
            'age' => 20,
            'size' => 0.60,
            'weight' => 75
        ]);
        Species::firstOrCreate([
            'id' => 5,
            'name' => 'ferus',
            'genus_id' => 4,
            'wiki' => 'https://en.wikipedia.org/wiki/Horse',
            'age' => 30,
            'size' => 1.83,
            'weight' => 1000
        ]);
        Species::firstOrCreate([
            'id' => 6,
            'name' => 'quagga',
            'genus_id' => 4,
            'wiki' => 'https://en.wikipedia.org/wiki/Plains_zebra',
            'age' => 20,
            'size' => 1.45,
            'weight' => 385
        ]);
        Species::firstOrCreate([
            'id' => 7,
            'name' => 'savaglia',
            'genus_id' => 6,
            'wiki' => 'https://en.wikipedia.org/wiki/Savalia_savaglia',
            'age' => 2700,
            'size' => 1,
            'weight' => 100
        ]);
        //savaglia 2700 years, 3 cm, sea floor
        Species::firstOrCreate([
            'id' => 8,
            'name' => 'giganteum',
            'genus_id' => 7,
            'wiki' => 'https://en.wikipedia.org/wiki/Sequoiadendron_giganteum',
            'age' => 3500,
            'size' => 95,
            'weight' => 1.8E5
        ]);
        Species::firstOrCreate([
            'id' => 9,
            'name' => 'sempervirens',
            'genus_id' => 7,
            'wiki' => 'https://en.wikipedia.org/wiki/Sequoia_sempervirens',
            'age' => 1800,
            'size' => 116,
            'weight' => 1.7E5
        ]);
    }
}
