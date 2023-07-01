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
        Schema::create('guardian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('depositor_id')->nullable(); 
            $table->string('g_fname');
            $table->string('g_lname');
            $table->string('g_mname');
            $table->string('g_suffix')->nullable();
            $table->date('g_birth_date');
            $table->string('g_gender');
            $table->string('g_depositor_relation');
            $table->string('g_civil_status');
            $table->string('g_member_or_not');
            $table->string('g_home_address');
            $table->string('g_present_address');
            $table->string('g_contact_num');
            $table->string('g_email_add')->nullable();
            $table->foreign('depositor_id')->references('id')->on('depositor')->onDelete('restrict');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardian');
    }
};
