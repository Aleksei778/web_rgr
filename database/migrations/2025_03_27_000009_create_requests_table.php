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
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
            $table->foreignId('property_id')
                  ->references('id')->on('properties')
                  ->onDelete('set null');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('phone', 11)->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_processed')->default(false);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
