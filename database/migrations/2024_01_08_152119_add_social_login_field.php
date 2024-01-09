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
        Schema::table('users', function ($table) {
            $table->string('provider');
                $table->string('provider_id');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         {
        Schema::dropColumns('provider');
	Schema::dropColumns('provider_id');
    }
    }
};
