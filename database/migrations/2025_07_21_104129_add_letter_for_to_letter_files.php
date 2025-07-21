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
        Schema::table('letter_files', function (Blueprint $table) {
            $table->string('letter_for', 50)->nullable()->after('letter_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letter_files', function (Blueprint $table) {
            $table->dropColumn('letter_for');
        });
    }
};