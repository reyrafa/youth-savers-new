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
        Schema::create('depositor', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('suffix')->nullable();
            $table->date('birth_date');
            $table->string('gender');
            $table->string('home_address');
            $table->string('contact_number');
            $table->string('email_add');
            $table->unsignedBigInteger('branch_loc_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('referral_id')->nullable();
            $table->unsignedBigInteger('uploaded_file_id')->nullable();

            $table->foreign('branch_loc_id')->references('id')->on('branch_location')->onDelete('restrict');
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('restrict');
            $table->foreign('referral_id')->references('id')->on('referral')->onDelete('restrict');
            $table->foreign('uploaded_file_id')->references('id')->on('uploaded_file')->onDelete('restrict');

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
        Schema::dropIfExists('depositor');
    }
};
