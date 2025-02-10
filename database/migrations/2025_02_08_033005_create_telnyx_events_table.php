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
        Schema::create('telnyx_events', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 28);
            $table->string('call_control_id');
            $table->string('event_type', 128);
            $table->string('command_id')->nullable();
            $table->string('client_state')->nullable();
            $table->json('payload')->nullable();
            $table->json('request')->nullable();
            $table->enum('status', ['processing', 'completed'])->default('processing');
            $table->timestamps();

            // Adding indexes
            $table->index('phone');
            $table->index('call_control_id');
            $table->index('event_type');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telnyx_events');
    }
};
