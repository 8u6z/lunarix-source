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
        Schema::create('user_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('sender_id');
            $table->text('subject');
            $table->text('body');
            $table->boolean('is_read');
            $table->timestamp('created_at');
            $table->boolean('is_archived');
            $table->boolean('is_system_message')->default(false);

            $table->index(['user_id', 'is_system_message', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_messages');
    }
};
