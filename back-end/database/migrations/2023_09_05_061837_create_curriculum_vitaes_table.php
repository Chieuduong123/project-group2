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
        Schema::create('curriculum_vitaes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seeker_id');
            $table->unsignedBigInteger('personal_detail_id');
            $table->unsignedBigInteger('social_id');
            $table->json('soft');
            $table->json('tech');
            $table->timestamps();

            $table->foreign('seeker_id')->references('id')->on('seekers')->onDelete('cascade');
            $table->foreign('personal_detail_id')->references('id')->on('personal_details')->onDelete('cascade');
            $table->foreign('social_id')->references('id')->on('socials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_vitaes');
    }
};
