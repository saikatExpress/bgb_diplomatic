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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_by', 100);
            $table->integer('bgb_region_id');
            $table->integer('bgb_sec_id');
            $table->integer('bgb_battalion_id');
            $table->integer('bgb_coy_id');
            $table->integer('bgb_bop_id');
            $table->integer('bsf_region_id');
            $table->integer('bsf_sec_id');
            $table->integer('bsf_battalion_id');
            $table->integer('bsf_coy_id');
            $table->integer('bsf_bop_id');
            $table->integer('letter_no')->unique();
            $table->date('letter_date');
            $table->integer('ltr_subject');
            $table->integer('ltr_incident');
            $table->integer('pillar_id');
            $table->integer('subpillar_id');
            $table->string('distance_from', 250);
            $table->string('within_150_km', 250);
            $table->string('outside_150_km', 250);
            $table->integer('killing');
            $table->integer('injuring');
            $table->integer('beating');
            $table->integer('firing');
            $table->integer('crossing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};