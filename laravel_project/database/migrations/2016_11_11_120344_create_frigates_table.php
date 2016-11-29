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
            $table->integer('orbitalbase_id');
            $table->integer('attack')->default(30);
            $table->integer('defence')->default(20);
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
        Schema::dropIfExists('frigates');
    }
}
