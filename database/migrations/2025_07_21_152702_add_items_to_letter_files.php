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
            $table->string('region')->nullable()->after('file_path');
            $table->string('sector')->nullable()->after('region');
            $table->string('battalion')->nullable()->after('sector');
            $table->string('company')->nullable()->after('battalion');
            $table->string('bop')->nullable()->after('company');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letter_files', function (Blueprint $table) {
            $table->dropColumn(['region', 'sector', 'battalion', 'company', 'bop']);
        });
    }
};