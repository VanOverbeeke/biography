<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiomesSpeciesLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('biome_species')) {
            Schema::create('biome_species', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->integer('biome_id')->unsigned();
                $table->integer('species_id')->unsigned();
            });
        }
        Schema::table('biome_species', function (Blueprint $table) {
            $table->foreign('biome_id')->references('id')->on('biomes')->onDelete('cascade');
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biome_species', function (Blueprint $table) {
            $table->dropForeign(['biome_id']);
            $table->dropForeign(['species_id']);
        });
        Schema::dropIfExists('biome_species');
    }
}
