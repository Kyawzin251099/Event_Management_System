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
        Schema::create('venue_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('platform_user_id');
            $table->unsignedBigInteger('venue_id');
            $table->unsignedBigInteger('rating_id');
            $table->timestamps();

            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->foreign('platform_user_id')->references('id')->on('platform_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venue_ratings');
    }
};
