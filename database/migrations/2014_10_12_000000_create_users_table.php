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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('gender');
            $table->text('hobbies');
            $table->string('instagram_username');
            $table->string('mobile_number');
            $table->boolean('casual_friends')->default(false);
            $table->integer('registration_price');
            $table->timestamps();
            $table->integer('wallet')->default(0);
            $table->string('profile_picture_url')->default('default.png');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
