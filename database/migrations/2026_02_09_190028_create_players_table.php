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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->string('slug')->unique();
            $table->integer('number');
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitch')->nullable();
            $table->text('photo')->nullable();
            $table->string('position', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->boolean('visible')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
