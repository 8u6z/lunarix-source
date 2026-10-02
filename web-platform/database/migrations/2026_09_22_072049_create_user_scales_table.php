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
        Schema::create('user_scales', function (Blueprint $table) {
            $table->bigInteger('userid');
            $table->decimal('height', 5)->nullable();
            $table->decimal('width', 5)->nullable();
            $table->decimal('head', 5)->nullable();
            $table->decimal('depth', 5)->nullable();
            $table->decimal('proportion', 5)->nullable();
            $table->string('bodytype', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_scales');
    }
};
