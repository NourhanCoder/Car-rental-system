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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->unsignedSmallInteger('luggage');
            $table->unsignedSmallInteger('doors');
            $table->unsignedSmallInteger('passengers');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('image');
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('available'); // available, rented, maintenance
            $table->timestamps();

            $table->index(['category_id', 'is_active', 'status']); //for best search performance
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
