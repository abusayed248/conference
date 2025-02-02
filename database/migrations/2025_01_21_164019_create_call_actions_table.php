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
        Schema::create('call_actions', function (Blueprint $table) {
            $table->id();
            $table->string('event')->nullable();
            $table->enum('type', ['greetings', 'non_subscriber_greetings', 'transfer', 'audio','none','sub_menu']);
            $table->unsignedSmallInteger('digit')->nullable(); // Integer with max length of 1 (0-255)
            $table->string('transfer_to', 28)->nullable(); // String with a max length of 28
            $table->integer('afer_time')->nullable();
            $table->string('audio_link')->nullable(); // String for audio link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_actions');
    }
};
