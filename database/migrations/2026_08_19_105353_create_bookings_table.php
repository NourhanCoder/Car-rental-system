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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->dateTime('pick_up_date');
            $table->dateTime('drop_off_date');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending'); // pending, confirmed, active, completed, cancelled
            $table->timestamps();

            $table->index(['car_id', 'pick_up_date', 'drop_off_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
