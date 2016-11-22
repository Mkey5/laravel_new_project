<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetalminesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metalmines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('homeplanet_id');
            $table->integer('income')->default(30);
            $table->integer('cost_gold')->default(150);
            $table->integer('cost_metal')->default(100);
            $table->integer('cost_energy')->default(300);
            $table->integer('level')->default(1);
            $table->dateTime('upgrating_time')->nullable();
            
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
        Schema::dropIfExists('metalmines');
    }
}
