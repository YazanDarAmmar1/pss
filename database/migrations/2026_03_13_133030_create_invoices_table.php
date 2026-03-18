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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('app_users')->cascadeOnDelete();
            $table->foreignId('cart_id')->nullable()->constrained('carts')->cascadeOnDelete();
            $table->text('no');
            $table->enum('status', ['pending', 'paid', 'failed', 'cancelled', 'invalid', 'error'])->default('pending');
            $table->decimal('amount', 18, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
