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
            $table->integer('orbitalbase_id');
            $table->integer('attack')->default(100);
            $table->integer('defence')->default(80);
            $table->integer('level')->default(1);
            $table->string('state')->default('docked');
            
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
