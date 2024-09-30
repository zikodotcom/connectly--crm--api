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
        Schema::create('task', function (Blueprint $table) {
            $table->id('id_task');
            $table->string('taskName', 255);
            $table->text('description');
            $table->date('dateS');
            $table->date('dateF');
            $table->string('status', 50);
            $table->string('priority', 10);
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('project')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
