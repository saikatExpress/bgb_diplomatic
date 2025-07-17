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
        Schema::create('letter_files', function (Blueprint $table) {
            $table->id();
            $table->string('letter_by', 50);
            $table->string('letter_number', 100);
            $table->string('file_name', 250)->nullable()->index();
            $table->string('file_path', 250);
            $table->enum('status', ['no_reply', 'replied'])->default('no_reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_files');
    }
};