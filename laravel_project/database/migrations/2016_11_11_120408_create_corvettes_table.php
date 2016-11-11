<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorvettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corvettes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipyard_id');
            $table->integer('attack')->default(50);
            $table->integer('defence')->default(50);
            $table->integer('cost_gold')->default(35);
            $table->integer('cost_metal')->default(50);
            $table->integer('cost_energy')->default(70);
            $table->integer('levelneeded')->default(2);
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
        Schema::dropIfExists('corvettes');
    }
}
