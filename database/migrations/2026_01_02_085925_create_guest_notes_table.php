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
        Schema::create('guest_notes', function (Blueprint $table) {
            $table->id();
            $table->uuid('guest_id');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique('guest_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_notes');
    }
};
