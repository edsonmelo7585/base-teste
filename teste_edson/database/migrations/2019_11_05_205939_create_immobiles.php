<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmobiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immobiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->bigInteger('immobiles_addresses_id')->unsigned();
            $table->foreign('immobiles_addresses_id')->references('id')->on('immobiles_addresses');                        
            $table->bigInteger('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('owners');            
            $table->bigInteger('immobiles_type_id')->unsigned();
            $table->foreign('immobiles_type_id')->references('id')->on('immobiles_types');                        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immobiles');
    }
}
