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
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->text('video_path');
            $table->integer('creator_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->boolean('is_music');
            $table->integer('visibility');
            $table->boolean('aftwld_classic');
            $table->text('thumbnail_path')->nullable();
            $table->integer('approval');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
