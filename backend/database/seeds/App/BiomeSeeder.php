<?php

use Illuminate\Database\Seeder;

use App\Biome;

class BiomeSeeder extends Seeder
{
    public function run()
    {
        Biome::firstOrCreate([
           'id' => 1,
           'name' => 'Atlantic Ocean'
        ]);
        Biome::firstOrCreate([
            'id' => 2,
            'name' => 'Mediterranean Sea'
        ]);
        Biome::firstOrCreate([
            'id' => 3,
            'name' => 'Asia'
        ]);
        Biome::firstOrCreate([
            'id' => 4,
            'name' => 'Serengeti'
        ]);
        Biome::firstOrCreate([
            'id' => 5,
            'name' => 'National Parks'
        ]);
        Biome::firstOrCreate([
            'id' => 6,
            'name' => 'Forests'
        ]);
        Biome::firstOrCreate([
            'id' => 7,
            'name' => 'North America'
        ]);
        Biome::firstOrCreate([
            'id' => 8,
            'name' => 'Sea Floor'
        ]);
        Biome::firstOrCreate([
            'id' => 9,
            'name' => 'Nile River'
        ]);
        Biome::firstOrCreate([
            'id' => 10,
            'name' => 'Northern Australia'
        ]);
        Biome::firstOrCreate([
            'id' => 11,
            'name' => 'Indonesia'
        ]);
        Biome::firstOrCreate([
            'id' => 12,
            'name' => 'Shores'
        ]);
        Biome::firstOrCreate([
            'id' => 13,
            'name' => 'Sub-Saharan Africa'
        ]);
        Biome::firstOrCreate([
            'id' => 14,
            'name' => 'Madagascar'
        ]);
        Biome::firstOrCreate([
            'id' => 15,
            'name' => 'Plains'
        ]);
    }
}
