<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attacker')->nullable();
            $table->integer('defender')->nullable();
            $table->string('winner')->nullable();
            $table->string('loser')->nullable();
            $table->integer('gold')->nullable();
            $table->integer('metal')->nullable();
            $table->integer('energy')->nullable();
            $table->text('battle_log')->nullable();
            $table->dateTime('battle_time')->nullable();
            $table->dateTime('return_time')->nullable();
            
            // something else :?

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('battles');
    }
}
