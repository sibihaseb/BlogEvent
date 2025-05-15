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
        Schema::create('event_tag', function (Blueprint $table) {
            $table->foreignId('church_event_id')->constrained()->onDelete('cascade');
            $table->foreignId('church_event_tag_id')->constrained()->onDelete('cascade');
            $table->primary(['church_event_id', 'church_event_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_tag');
    }
};
