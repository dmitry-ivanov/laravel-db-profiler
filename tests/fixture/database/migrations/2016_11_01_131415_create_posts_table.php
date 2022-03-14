<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->float('price');
            $table->boolean('is_enabled');
            $table->timestamps();
        });
    }

    /**
     * Rollback the migration.
     */
    public function down(): void
    {
        Schema::drop('posts');
    }
};
