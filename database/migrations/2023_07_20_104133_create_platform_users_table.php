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
        Schema::create('platform_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->tinyInteger('role')->default(0)->comment('1=Individual, 2=Corporate, 3=Partner');
            $table->tinyInteger('active')->default(7);
            $table->tinyInteger('logged')->default(6);
            $table->string('commercial_name')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('join_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->timestamps();

            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_users');
    }
};
