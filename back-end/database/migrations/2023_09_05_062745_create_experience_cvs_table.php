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
        Schema::create('experience_cvs', function (Blueprint $table) {
            $table->unsignedBigInteger('cv_id');
            $table->unsignedBigInteger('experience_id');

            $table->foreign('cv_id')->references('id')->on('curriculum_vitaes')->onDelete('cascade');
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_cvs');
    }
};
