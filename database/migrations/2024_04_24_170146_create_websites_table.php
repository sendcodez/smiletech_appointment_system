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
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('business_name');
            $table->string('store_close');
            $table->string('store_hour_start');
            $table->string('store_hour_end');
            $table->string('address');
            $table->string('email');
            $table->string('contact_number');
            $table->string('about');
            $table->string('tagline');
            $table->string('customer_morning')->default(3);
            $table->string('customer_afternoon')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
