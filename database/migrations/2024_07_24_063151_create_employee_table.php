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
        Schema::create('employee', function (Blueprint $table) {
            $table->id('id_e');
            $table->string('fullName', 255);
            $table->string('userName', 255);
            $table->string('email', 255);
            $table->string('phone', 30);
            $table->string('nationality', 100);
            $table->string('adresse', 255);
            $table->string('city', 255);
            $table->string('state', 100);
            $table->string('zipCode', 30);
            $table->string('country', 255);
            $table->text('photo');
            $table->string('role', 255);
            $table->decimal('salary',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
