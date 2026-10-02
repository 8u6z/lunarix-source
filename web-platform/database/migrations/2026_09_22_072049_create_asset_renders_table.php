<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asset_renders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_id');
            $table->integer('asset_type');
            $table->text('render_path');
            $table->text('render_type');
            $table->timestamp('created_at')->default(DB::raw("now()"));
            $table->boolean('is_place_thumbnail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_renders');
    }
};
