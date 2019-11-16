<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingHourTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::dropIfExists('working_hour'); 
        Schema::create('working_hour', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('office_id');
            $table->string('days')->nullable();
            $table->time('start_time');
            $table->time('finish_time');
            $table->time('start_time1')->nullable();
            $table->time('finish_time1')->nullable();
            $table->integer('type_id')->default('0');
            $table->integer('create_user_id')->nullable();
            $table->foreign('office_id')->references('id')->on('office')->onDelete('cascade');
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
        Schema::dropIfExists('working_hour');
    }
}
