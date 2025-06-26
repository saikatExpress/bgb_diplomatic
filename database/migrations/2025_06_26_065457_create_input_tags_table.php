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
        Schema::create('input_tags', function (Blueprint $table) {
            $table->id();
            $table->string('input_label', 250)->unique();
            $table->string('input_name', 250)->unique();
            $table->string('placeholder', 250);
            $table->string('icon', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_tags');
    }
};