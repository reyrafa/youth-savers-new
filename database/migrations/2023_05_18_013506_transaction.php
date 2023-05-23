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
        Schema::create('transaction', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('depositor_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->string('remarks')->nullable();

            $table->foreign('depositor_id')->references('id')->on('depositor')->onDelete('restrict');
            $table->foreign('level_id')->references('id')->on('level')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('transaction_status')->onDelete('restrict');
            $table->foreign('officer_id')->references('id')->on('officer')->onDelete('restrict');
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
        Schema::dropIfExists('transaction');
    }
};
