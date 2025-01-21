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
        Schema::create('call_action_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('call_action_id')
                ->constrained('call_actions') // Ensures it references the `id` column on the `call_actions` table
                ->onDelete('cascade');        // Deletes related records if the parent is deleted
            $table->bigInteger('number')->nullable();
            $table->integer('need_time_for_transfer')->nullable();
            $table->integer('afer_time')->nullable();
            $table->string('audio_link')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_action_details');
    }
};
