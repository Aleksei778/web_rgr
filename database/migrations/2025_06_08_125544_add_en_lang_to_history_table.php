<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE history ALTER COLUMN title TYPE json USING title::json;');
        DB::statement('ALTER TABLE history ALTER COLUMN content TYPE json USING content::json;');
        Schema::table('history', function (Blueprint $table) {
            // Add any other changes to the table, e.g., setting NOT NULL
            $table->json('title')->nullable(false)->change();
            $table->json('content')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('history', function (Blueprint $table) {
            // Revert the column back to its original type (e.g., text or varchar)
            $table->string('title')->nullable(false)->change();
            $table->text('content')->nullable(false)->change();
        });
    }
};
