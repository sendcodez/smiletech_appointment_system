<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->boolean('is_no_show')->default(false)->after('status');
            $table->timestamp('marked_no_show_at')->nullable()->after('is_no_show');
        });
        
        // Create user penalties table
        Schema::create('user_penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('no_show_count')->default(0);
            $table->boolean('is_blocked')->default(false);
            $table->timestamp('blocked_until')->nullable();
            $table->text('penalty_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['is_no_show', 'marked_no_show_at']);
        });
        
        Schema::dropIfExists('user_penalties');
    }
};
