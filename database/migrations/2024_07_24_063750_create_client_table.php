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
        Schema::create('client', function (Blueprint $table) {
            $table->id('idC');
            $table->text('image');
            $table->string('clientName', 255);
            $table->string('email', 255);
            $table->string('phone', 30);
            $table->string('website', 255);
            $table->string('owner', 255);
            $table->string('industry', 255);
            $table->string('currency', 30);
            $table->string('languages', 50);
            $table->text('description');
            $table->string('adresse', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('country', 255);
            $table->string('zipCode', 255);
            $table->text('facebook');
            $table->text('linkedin');
            $table->text('twitter');
            $table->text('instgram');
            $table->string('whatsapp', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
