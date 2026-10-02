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
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->boolean('locked')->nullable()->default(false);
            $table->string('name');
            $table->string('description', 1255)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('is_verified')->nullable()->default(false);
            $table->boolean('is_staff_group')->nullable()->default(false);
            $table->boolean('is_bc_only')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
