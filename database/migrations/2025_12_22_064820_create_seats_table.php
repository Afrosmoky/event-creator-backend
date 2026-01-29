<?php

use App\Models\Element;
use App\Models\Guest;
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
        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')->references('id')->on('elements')->cascadeOnDelete();

            $table->integer('index');
            $table->string('label')->nullable();

            $table->uuid('guest_id')->nullable()->index();
            $table->uuid('ballroom_id')->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
