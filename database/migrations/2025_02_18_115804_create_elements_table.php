<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Element;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('name');
            $table->string('type');
            $table->integer('ballroom_id')->index();
            $table->integer('parent_id')->index();
            $table->integer('x');
            $table->integer('y');
            $table->string('color')->nullable();
            $table->string('kind');
            $table->double('spacing');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('element_configs', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignIdFor(Element::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('type');
            $table->string('seats');
            $table->string('radius');
            $table->double('width');
            $table->double('height');
            $table->double('size');
            $table->double('angle');
            $table->double('angle_origin_x');
            $table->double('angle_origin_y');
            $table->timestamps();
        });

        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('guest_id');
            $table->foreignIdFor(Element::class)
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('ballroom_id')->index();
            $table->jsonb('parameters')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements');
        Schema::dropIfExists('element_configs');
        Schema::dropIfExists('guests');
    }
};
