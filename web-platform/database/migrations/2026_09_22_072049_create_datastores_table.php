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
        Schema::create('datastores', function (Blueprint $table) {
            $table->increments('id');
            $table->text('key');
            $table->integer('universe_id');
            $table->string('type', 50);
            $table->text('scope');
            $table->text('target');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datastores');
    }
};
