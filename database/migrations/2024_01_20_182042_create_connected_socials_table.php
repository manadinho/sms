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
        Schema::create('connected_socials', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_social_profile_id');
            $table->string('provider');
            $table->string('connected_social_id');
            $table->string('type');
            $table->string('title');
            $table->longText('access_token')->nullable();
            $table->text('photo')->nullable();
            $table->longText('misc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connected_socials');
    }
};
