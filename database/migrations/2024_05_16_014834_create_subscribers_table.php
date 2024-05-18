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
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('status', [
                SubscriberStatusType::SUBSCRIBED->value,
                SubscriberStatusType::UNSUBSCRIBED->value
            ])->default(SubscriberStatusType::SUBSCRIBED->value);
            $table->timestamp('unsubscribe_at');
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
