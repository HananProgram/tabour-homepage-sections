<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('homepage_sections')) {
            return;
        }

        Schema::create('homepage_sections', function (Blueprint $t) {
            $t->id();
            $t->string('type', 255);              // hero, feature_grid, cta
            $t->string('title', 255)->nullable();
            $t->text('subtitle')->nullable();
            $t->string('image_path', 255)->nullable();
            $t->longText('content')->nullable();  // JSON as text
            $t->integer('order')->default(0);
            $t->boolean('is_visible')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};
