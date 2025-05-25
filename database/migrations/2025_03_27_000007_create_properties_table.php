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
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('category_id')
                  ->references('id')->on('property_categories')
                  ->onDelete('set null');
            $table->string('title', 255);
            $table->text('address');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->decimal('price', 15, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
