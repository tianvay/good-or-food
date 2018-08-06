<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonsterSkilleffectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        //
        Schema::create('monster_skilleffect', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('monster_id');
            $table->integer('skilleffect_id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('monster_skilleffect');
    }
}
