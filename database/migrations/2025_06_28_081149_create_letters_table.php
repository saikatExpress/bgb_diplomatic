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
            $table->integer('bgb_sec_id')->nullable();
            $table->integer('bgb_battalion_id')->nullable();
            $table->integer('bgb_coy_id')->nullable();
            $table->integer('bgb_bop_id')->nullable();
            $table->integer('bsf_region_id');
            $table->integer('bsf_sec_id')->nullable();
            $table->integer('bsf_battalion_id')->nullable();
            $table->integer('bsf_coy_id')->nullable();
            $table->integer('bsf_bop_id')->nullable();
            $table->string('letter_no', 250)->unique();
            $table->date('letter_date');
            $table->string('ltr_subject', 250);
            $table->string('ltr_incident', 250);
            $table->integer('pillar_id');
            $table->string('subpillar_id', 250)->nullable();
            $table->string('subpillar_type', 250)->nullable();
            $table->string('distance_from', 250)->nullable();
            $table->string('distance_unit', 50)->nullable();
            $table->string('tags', 500);
            $table->integer('killing')->nullable();
            $table->integer('injuring')->nullable();
            $table->integer('beating')->nullable();
            $table->integer('firing')->nullable();
            $table->integer('crossing')->nullable();
            $table->enum('status', ['replied', 'no_reply'])->default('no_reply');
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