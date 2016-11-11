<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePowerplantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('powerplants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('homeplanet_id');
            $table->integer('income')->default(50);
            $table->integer('cost_gold')->default(100);
            $table->integer('cost_metal')->default(100);
            $table->integer('cost_energy')->default(100);
            $table->integer('level')->default(1);
            
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
        Schema::dropIfExists('powerplants');
    }
}
