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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('antibiotic')->default(0);
            $table->boolean('smoke')->default(0);
            $table->boolean('treated')->default(0);
            $table->boolean('hospitalized')->default(0);
            $table->boolean('abnormal')->default(0);
            $table->boolean('pregnant')->default(0);
            $table->boolean('prescription')->default(0);
            $table->text('medications');
            $table->text('allergies');
            $table->text('known_allergies');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
