<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BiomeSpeciesSeeder extends Seeder
{
    public function run()
    {
        DB::table('biome_species')->insert([
            'id' => 1,
            'biome_id' => 1,
            'species_id' => 7
        ]);
        DB::table('biome_species')->insert([
            'id' => 2,
            'biome_id' => 2,
            'species_id' => 7
        ]);
        DB::table('biome_species')->insert([
            'id' => 3,
            'biome_id' => 8,
            'species_id' => 7
        ]);
        DB::table('biome_species')->insert([
            'id' => 4,
            'biome_id' => 3,
            'species_id' => 4
        ]);
        DB::table('biome_species')->insert([
            'id' => 5,
            'biome_id' => 4,
            'species_id' => 3
        ]);
        DB::table('biome_species')->insert([
            'id' => 6,
            'biome_id' => 5,
            'species_id' => 8
        ]);
        DB::table('biome_species')->insert([
            'id' => 7,
            'biome_id' => 6,
            'species_id' => 9
        ]);
        DB::table('biome_species')->insert([
            'id' => 8,
            'biome_id' => 4,
            'species_id' => 6
        ]);
        DB::table('biome_species')->insert([
            'id' => 9,
            'biome_id' => 7,
            'species_id' => 5
        ]);
        DB::table('biome_species')->insert([
            'id' => 10,
            'biome_id' => 13,
            'species_id' => 2
        ]);
        DB::table('biome_species')->insert([
            'id' => 11,
            'biome_id' => 9,
            'species_id' => 2
        ]);
        DB::table('biome_species')->insert([
            'id' => 12,
            'biome_id' => 12,
            'species_id' => 1
        ]);
        DB::table('biome_species')->insert([
            'id' => 13,
            'biome_id' => 11,
            'species_id' => 1
        ]);
        DB::table('biome_species')->insert([
            'id' => 14,
            'biome_id' => 14,
            'species_id' => 2
        ]);
        DB::table('biome_species')->insert([
            'id' => 15,
            'biome_id' => 10,
            'species_id' => 1
        ]);
        DB::table('biome_species')->insert([
            'id' => 16,
            'biome_id' => 13,
            'species_id' => 3
        ]);
        DB::table('biome_species')->insert([
            'id' => 17,
            'biome_id' => 15,
            'species_id' => 5
        ]);
        DB::table('biome_species')->insert([
            'id' => 18,
            'biome_id' => 7,
            'species_id' => 8
        ]);
        DB::table('biome_species')->insert([
            'id' => 19,
            'biome_id' => 7,
            'species_id' => 9
        ]);
        DB::table('biome_species')->insert([
            'id' => 20,
            'biome_id' => 6,
            'species_id' => 8
        ]);
        DB::table('biome_species')->insert([
            'id' => 21,
            'biome_id' => 5,
            'species_id' => 9
        ]);
        DB::table('biome_species')->insert([
            'id' => 22,
            'biome_id' => 5,
            'species_id' => 3
        ]);
    }
}