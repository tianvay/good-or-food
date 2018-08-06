<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('com2usid')->unique();
            $table->text('type');
            $table->text('name');
            $table->boolean('is_awakened');
            $table->boolean('fusion_food');
            $table->text('awakens_from')->nullable();
            $table->text('awakens_to')->nullable();
            $table->text('element');
            $table->text('pic');
            for($i=1;$i<5;$i++){
                $table->text('s' . $i . 'name')->nullable();
                $table->text('s' . $i . 'cd')->nullable();
                #$table->text('s' . $i . 'skill_effect')->nullable();
                $table->text('s' . $i . 'pic')->nullable();
                $table->text('s' . $i . 'level_progress_description')->nullable();
                $table->text('s' . $i . 'description')->nullable();
            }
            $table->text('article')->default(null)->nullable();
            $table->boolean('leader_skill')->default(null)->nullable();
            $table->text('leader_area')->default(null)->nullable();
            $table->text('leader_element')->default(null)->nullable();
            $table->text('leader_attribute')->default(null)->nullable();
            $table->text('leader_amount')->default(null)->nullable();

            $table->timestamps();
            $table->date('motd')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}
