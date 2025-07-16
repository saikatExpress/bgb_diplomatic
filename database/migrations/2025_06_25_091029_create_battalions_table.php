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
        Schema::create('battalions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sector_id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('lat', 250)->nullable();
            $table->string('lon', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('battalions');
    }
};
