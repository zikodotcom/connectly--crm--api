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
        Schema::table('client', function (Blueprint $table) {
            $table->text('facebook')->nullable()->change();
            $table->text('linkedin')->nullable()->change();
            $table->text('twitter')->nullable()->change();
            $table->text('instgram')->nullable()->change();
            $table->string('whatsapp', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('be_nullable', function (Blueprint $table) {
            //
        });
    }
};
