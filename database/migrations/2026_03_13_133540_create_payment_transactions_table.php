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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('app_users')->nullOnDelete();
            $table->text('payment_url')->nullable();
            $table->text('global_transaction_id')->nullable();
            $table->string('no')->unique();
            $table->decimal('amount', 18, 3);
            $table->enum('status', ['pending', 'paid', 'failed', 'down', 'cancelled', 'invalid', 'error'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
