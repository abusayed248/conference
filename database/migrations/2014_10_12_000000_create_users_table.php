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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('')->unique()->nullable();
            $table->tinyInteger('is_cancel_free_trial')->nullable();
            $table->text('card_number')->nullable();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('stripe_customer_id')->nullable();
            $table->tinyInteger('payment_done')->nullable();
            $table->timestamp('free_trial')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('payment_end')->nullable();
            $table->string('stripe_subcription_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
