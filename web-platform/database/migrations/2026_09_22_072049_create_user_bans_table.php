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
        Schema::create('user_bans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userid');
            $table->text('mod_note')->nullable();
            $table->timestamp('expiry')->nullable();
            $table->json('reasonids')->nullable();
            $table->timestamps();
            $table->boolean('is_warning')->default(false);
            $table->bigInteger('moderator_id')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->bigInteger('revoked_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_bans');
    }
};
