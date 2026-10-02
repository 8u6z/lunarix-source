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
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('UserId');
            $table->integer('PlaceId')->default(0);
            $table->string('JobId', 64)->default('');
            $table->text('Comment')->nullable();
            $table->text('Messages')->nullable();
            $table->text('RawXML');
            $table->timestamp('CreatedAt');
            $table->boolean('MarkAsResolved')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
