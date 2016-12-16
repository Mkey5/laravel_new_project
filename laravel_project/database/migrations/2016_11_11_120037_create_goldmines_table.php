<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoldminesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goldmines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('homeplanet_id');
            $table->integer('income')->default(10);
            $table->integer('cost_gold')->default(300);
            $table->integer('cost_metal')->default(290);
            $table->integer('cost_energy')->default(370);
            $table->integer('level')->default(1);
            $table->dateTime('upgrating_time');
            
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
        Schema::dropIfExists('goldmines');
    }
}
