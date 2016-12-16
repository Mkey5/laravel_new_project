<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipyardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipyards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orbitalbase_id');
            $table->integer('cost_gold')->default(500);
            $table->integer('cost_metal')->default(400);
            $table->integer('cost_energy')->default(480);
            $table->integer('level')->default(1);
            $table->dateTime('upgrating_time');
            $table->dateTime('frigate_time');
            $table->dateTime('corvette_time');
            $table->dateTime('destroyer_time');
            $table->dateTime('assaultcarrier_time');
            
            
            
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
        Schema::dropIfExists('shipyards');
    }
}
