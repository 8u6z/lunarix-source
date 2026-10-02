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
        Schema::create('forums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('description');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->bigInteger('forum_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forums');
    }
};
