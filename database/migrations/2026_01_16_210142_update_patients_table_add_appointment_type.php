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
    Schema::table('appointments', function (Blueprint $table) {
        $table->boolean('appointment_type')->default(true);
        $table->string('name')->nullable();
    });
}

public function down(): void
{

}
};
