<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        
        Schema::dropIfExists('working_hour'); 
        Schema::dropIfExists('appointment'); 
        Schema::dropIfExists('office');
        
        Schema::create('office', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->integer('no_of_stretcher');
            $table->integer('state_id')->default('0');
            $table->integer('type_id')->default('0');
            $table->integer('create_user_id')->nullable();
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
        Schema::dropIfExists('office');
    }
}
