<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('rune_id');
            $table->bigInteger('wizard_id');
            $table->integer('user_id');
            $table->integer('class');
            $table->integer('stars');
            $table->integer('slot');
            $table->string('set');
            $table->string('mainstat');
            $table->integer('mainstat_value');
            $table->string('innate')->nullable()->default(null);
            $table->integer('innate_value')->nullable()->default(null);
            $table->string('substat1')->nullable()->default(null);
            $table->integer('substat1_value')->nullable()->default(null);
            $table->integer('substat1_grind')->nullable()->default(null);
            $table->string('substat2')->nullable()->default(null);
            $table->integer('substat2_value')->nullable()->default(null);
            $table->integer('substat2_grind')->nullable()->default(null);
            $table->string('substat3')->nullable()->default(null);
            $table->integer('substat3_value')->nullable()->default(null);
            $table->integer('substat3_grind')->nullable()->default(null);
            $table->string('substat4')->nullable()->default(null);
            $table->integer('substat4_value')->nullable()->default(null);
            $table->integer('substat4_grind')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runes');
    }
}
