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
        Schema::create('collaborators', function (Blueprint $table) {
            $table->unsignedBigInteger('id_task');
            $table->foreign('id_task')->references('id_task')->on('task')->onDelete('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_e');
            $table->foreign('id_e')->references('id_e')->on('employee')->onDelete('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }
};
