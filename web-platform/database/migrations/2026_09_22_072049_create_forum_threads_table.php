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
        Schema::create('forum_threads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('author_id');
            $table->text('subject');
            $table->bigInteger('forum_id');
            $table->boolean('is_pinned');
            $table->boolean('is_locked');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_threads');
    }
};
