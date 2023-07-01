<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officer', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('uid')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->string('company_id')->unique()->nullable();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');

            $table->foreign('uid')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('restrict');
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
        Schema::dropIfExists('officer');
    }
};
