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
        Schema::create('medical_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('steriod')->default(0);
            $table->boolean('rheumatic')->default(0);
            $table->boolean('epilepsy')->default(0);
            $table->boolean('asthma')->default(0);
            $table->boolean('diabetes')->default(0);
            $table->boolean('heart_disorder')->default(0);
            $table->boolean('bone_disease')->default(0);
            $table->boolean('radiation')->default(0);
            $table->boolean('kidney_disease')->default(0);
            $table->boolean('excessive_bleeding')->default(0);
            $table->boolean('stroke')->default(0);
            $table->boolean('cancer')->default(0);
            $table->boolean('tuberculosis')->default(0);
            $table->boolean('thyroid_disease')->default(0);
            $table->boolean('nervous')->default(0);
            $table->boolean('high_blood')->default(0);
            $table->boolean('prosthetic_implant')->default(0);
            $table->boolean('cardiac_pacemaker')->default(0);
            $table->boolean('stomach_condition')->default(0);
            $table->boolean('hepatitis')->default(0);
            $table->boolean('blood_borne')->default(0);
            $table->boolean('bronchitis')->default(0);
            $table->boolean('anaemia')->default(0);
            $table->boolean('other_condition')->default(0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_conditions');
    }
};
