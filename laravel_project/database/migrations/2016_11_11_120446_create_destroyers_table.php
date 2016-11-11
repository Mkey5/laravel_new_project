<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDestroyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destroyers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipyard_id');
            $table->integer('attack')->default(100);
            $table->integer('defence')->default(80);
            $table->integer('cost_gold')->default(95);
            $table->integer('cost_metal')->default(110);
            $table->integer('cost_energy')->default(120);
            $table->integer('levelneeded')->default(3);
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
        Schema::dropIfExists('destroyers');
    }
}
