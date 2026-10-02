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
        Schema::create('user_body', function (Blueprint $table) {
            $table->bigInteger('userid');
            $table->string('headcolor', 20)->nullable();
            $table->string('leftarmcolor', 20)->nullable();
            $table->string('leftlegcolor', 20)->nullable();
            $table->string('rightarmcolor', 20)->nullable();
            $table->string('rightlegcolor', 20)->nullable();
            $table->string('torsocolor', 20)->nullable();
            $table->enum('avatartype', ['R6', 'R15'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_body');
    }
};
