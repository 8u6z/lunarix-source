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
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('creator_id');
            $table->bigInteger('type');
            $table->text('name');
            $table->text('description');
            $table->integer('access');
            $table->boolean('can_comment');
            $table->boolean('onsale');
            $table->integer('sales_count');
            $table->integer('current_version_id')->nullable();
            $table->boolean('ghosted');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->integer('robux');
            $table->integer('visits')->default(0);
            $table->integer('max_players')->default(8);
            $table->json('genres')->nullable();
            $table->json('gear_types')->nullable();
            $table->integer('related_to')->nullable();
            $table->integer('universe_id')->nullable();
            $table->integer('approval')->default(0);
            $table->boolean('is_limited')->default(false);
            $table->boolean('is_limited_unique')->default(false);
            $table->integer('limited_quantity')->nullable();
            $table->boolean('staff_picks')->nullable();
            $table->integer('thumbnail_approval')->default(1);
            $table->integer('thumbnail_square_approval')->default(1);
            $table->boolean('lunarix_classic')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
