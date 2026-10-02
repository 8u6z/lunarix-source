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
        Schema::create('admin_user_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('actor_id')->index();
            $table->bigInteger('target_id')->nullable()->index();
            $table->string('action');
            $table->json('details')->nullable();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_user_actions');
    }
};
