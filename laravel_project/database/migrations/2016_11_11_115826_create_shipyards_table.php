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
            $table->integer('cost_gold')->default(200);
            $table->integer('cost_metal')->default(200);
            $table->integer('cost_energy')->default(200);
            $table->integer('level')->default(1);
            $table->dateTime('upgrating_time')->nullable();
            $table->dateTime('frigate_time')->nullable();
            $table->dateTime('corvette_time')->nullable();
            $table->dateTime('destroyer_time')->nullable();
            $table->dateTime('assaultcarrier_time')->nullable();
            
            
            
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
