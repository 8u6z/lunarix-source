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
        Schema::create('user_renders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('render_path');
            $table->text('render_type');
            $table->timestamp('created_at')->nullable()->default(DB::raw("now()"));
            $table->boolean('outdated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_renders');
    }
};
