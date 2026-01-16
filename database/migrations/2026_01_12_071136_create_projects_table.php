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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('no');
            $table->text('name');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('status')
                ->default('new')
                ->comment('new, pending, active, disabled');
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->decimal('default_amount', 18, 3)->nullable()->default(1);
            $table->decimal('target_amount', 18, 3)->nullable()->default(0);
            $table->decimal('paid_amount', 18, 3)->nullable()->default(0);
            $table->decimal('remaining_amount', 18, 3)->nullable()->default(0);
            $table->decimal('rate', 5)->default(0);
            $table->text('image_path');
            $table->text('description');
            $table->text('short_description');
            $table->boolean('is_seasonal')->default(false);
            $table->date('seasonal_start')->nullable();
            $table->date('seasonal_end')->nullable();
            $table->boolean('hide_on_complete')->default(false);
            $table->boolean('show_counter')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
