<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFrigatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frigates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipyard_id');
            $table->integer('attack')->default(30);
            $table->integer('defence')->default(20);
            $table->integer('cost_gold')->default(20);
            $table->integer('cost_metal')->default(30);
            $table->integer('cost_energy')->default(50);
            $table->integer('levelneeded')->default(1);
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
        Schema::dropIfExists('frigates');
    }
}
