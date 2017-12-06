<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('species')) {
            Schema::create('species', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->integer('genus_id')->unsigned();
                $table->timestamps();
                $table->string('wiki');
                $table->float('age');
                $table->float('size');
                $table->float('weight', 8);
            });
        }
        Schema::table('species', function (Blueprint $table) {
            $table->foreign('genus_id')->references('id')->on('genus')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('species', function (Blueprint $table) {
            $table->dropForeign(['genus_id']);
        });
        Schema::dropIfExists('species');
    }
}
