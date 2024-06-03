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
        Schema::table('campaign_emails', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['subscriber_id']);

            // Make columns nullable
            $table->unsignedBigInteger('subscriber_id')->nullable()->change();

            // Add new foreign key constraints with onDelete('set null')
            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('set null');

            // Add new columns
            $table->string('subscriber_email')->after('subscriber_id');
            $table->string('subscriber_first_name')->nullable()->default(null)->after('subscriber_email');
            $table->string('subscriber_last_name')->nullable()->default(null)->after('subscriber_first_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
