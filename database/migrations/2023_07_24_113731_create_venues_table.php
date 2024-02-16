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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('platform_user_id');
            $table->unsignedBigInteger('type_id');
            $table->string('venue_title');
            $table->string('unit_type');
            $table->integer('capacity');
            $table->date('avail_start_date');
            $table->date('avail_end_date');
            $table->time('avail_start_time');
            $table->time('avail_end_time');
            $table->float('price');
            $table->string('description');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('platform_user_id')->references('id')->on('platform_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
