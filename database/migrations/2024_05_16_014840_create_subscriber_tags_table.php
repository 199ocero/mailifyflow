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
        Schema::create('subscriber_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('team_id');
            $table->foreignId('tag_id');
            $table->foreignId('subscriber_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriber_tags');
    }
};
