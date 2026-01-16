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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_path');
            $table->boolean('status')->default(true);
            $table->boolean('first_button_visibility')->default(false);
            $table->boolean('second_button_visibility')->default(false);
            $table->string('first_button_text')->nullable();
            $table->string('second_button_text')->nullable();
            $table->string('first_button_link')->nullable();
            $table->string('second_button_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
