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
            $table->integer('attacker')->default(0);
            $table->integer('defender')->default(0);
            $table->integer('winner')->default(0);
            $table->integer('loser')->default(0);
            $table->integer('gold')->default(0);
            $table->integer('metal')->default(0);
            $table->integer('energy')->default(0);
            $table->double('ships_losses')->default(0.0);
            $table->dateTime('battle_time');
            $table->dateTime('return_time');
            $table->timestamps();
            
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
