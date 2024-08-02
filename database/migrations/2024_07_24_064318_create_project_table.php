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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->string('projectName', 255);
            $table->date('dateS');
            $table->date('dateF');
            $table->string('priority', 50);
            $table->string('status', 20);
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('idC');
            $table->foreign('idC')->references('idC')->on('client')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
