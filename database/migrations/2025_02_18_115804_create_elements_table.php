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
            $table->id();

            $table->uuid('public_id')->default(DB::raw('gen_random_uuid()'))->unique();

            $table->string('name')->nullable();
            $table->string('type')->nullable();

            $table->string('index')->nullable();   // legacy / frontend
            $table->string('focus')->nullable();   // legacy / frontend
            $table->string('icon')->nullable();

            $table->integer('parent_id')->nullable()->index();

            $table->double('x');
            $table->double('y');

            $table->string('color')->nullable();
            $table->string('kind');
            $table->double('spacing');
            $table->string('status');

            $table->integer('width')->nullable()->default(0);
            $table->integer('height')->nullable()->default(0);
            $table->integer('angle')->nullable()->default(0);

            $table->uuid('ballroom_id')->nullable()->index();

            $table->jsonb('jsonb')->nullable();

            $table->timestamps();
        });

        Schema::create('element_configs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('element_id')
                ->nullable()
                ->constrained('elements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('seats')->nullable();
            $table->string('radius')->nullable();

            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('size')->nullable();

            $table->double('angle')->nullable();
            $table->double('angle_origin_x')->nullable();
            $table->double('angle_origin_y')->nullable();

            $table->integer('arms_width')->nullable();
            $table->integer('bottom_height')->nullable();
            $table->integer('top_height')->nullable();
            $table->integer('bottom_width')->nullable();

            $table->boolean('show_unseated')->default(false);

            $table->string('border_color')->nullable();
            $table->integer('border_width')->nullable();

            $table->string('name_color')->nullable();
            $table->integer('name_font_size')->nullable();
            $table->boolean('name_bold')->nullable();
            $table->boolean('name_italic')->nullable();

            $table->integer('seat_facing')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elements');
        Schema::dropIfExists('element_configs');
    }
};
