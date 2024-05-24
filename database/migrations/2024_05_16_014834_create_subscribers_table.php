<?php

use App\Enum\SubscriberStatusType;
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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('status', [
                SubscriberStatusType::SUBSCRIBED->value,
                SubscriberStatusType::UNSUBSCRIBED->value
            ])->default(SubscriberStatusType::SUBSCRIBED->value);
            $table->timestamp('unsubscribe_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
