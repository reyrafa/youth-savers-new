<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique();
            $table->string('password');
            $table->unsignedBigInteger('user_type_id');
            $table->unsignedBigInteger('user_status_id');    
            $table->rememberToken();

            $table->foreign('user_type_id')->references('id')->on('user_type')->onDelete('restrict');
            $table->foreign('user_status_id')->references('id')->on('user_Status')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
