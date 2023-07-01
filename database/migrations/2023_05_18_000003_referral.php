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
        Schema::create('referral', function(Blueprint $table){
            $table->id();
            $table->string('r_fname')->nullable();
            $table->string('r_mname')->nullable();
            $table->string('r_lname')->nullable();
            $table->unsignedBigInteger('r_branch_loc_id')->nullable();
            $table->unsignedBigInteger('r_branch_id')->nullable();
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
        Schema::dropIfExists('referral');
    }
};
