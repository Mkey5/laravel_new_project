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
            $table->integer('orbitalbase_id');
            $table->integer('attack')->default(50);
            $table->integer('defence')->default(50);
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
        Schema::dropIfExists('corvettes');
    }
}
