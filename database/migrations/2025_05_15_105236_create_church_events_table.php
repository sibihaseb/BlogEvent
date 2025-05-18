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
        Schema::create('church_events', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();
            $table->string('name');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->string('location')->nullable();
            $table->enum('type', ['recurring', 'one_day']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('church_events');
    }
};
