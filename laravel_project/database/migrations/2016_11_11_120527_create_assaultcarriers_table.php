<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssaultcarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assaultcarriers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipyard_id');
            $table->integer('attack')->default(500);
            $table->integer('defence')->default(480);
            $table->integer('cost_gold')->default(350);
            $table->integer('cost_metal')->default(600);
            $table->integer('cost_energy')->default(820);
            $table->integer('levelneeded')->default(5);
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
        Schema::dropIfExists('assaultcarriers');
    }
}
