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
            $table->string('reply_no', 250)->nullable()->after('letter_number')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letter_files', function (Blueprint $table) {
            $table->dropColumn('reply_no');
        });
    }
};