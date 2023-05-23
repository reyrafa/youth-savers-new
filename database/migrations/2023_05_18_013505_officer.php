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
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('branch_loc_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('company_id')->unique();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
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
