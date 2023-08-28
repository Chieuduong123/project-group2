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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->string('position');
            $table->json('level');
            $table->decimal('salary', 9, 3)->nullable();
            $table->text('content');
            $table->json('skill');
            $table->json('type');
            $table->text('requirement');
            $table->bigInteger('quantity');
            $table->text('benefits');
            $table->date('start_day');
            $table->date('end_day');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
