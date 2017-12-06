<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GenusSeeder::class);
        $this->call(SpeciesSeeder::class);
        $this->call(BiomeSeeder::class);
        $this->call(BiomeSpeciesSeeder::class);
    }
}
