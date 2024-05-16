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
        Schema::create('team_emailservice', function (Blueprint $table) {
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('emailservice_id')->constrained('emailservices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_emailservice');
    }
};
