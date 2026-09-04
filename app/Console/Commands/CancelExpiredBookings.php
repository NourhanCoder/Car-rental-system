<?php

namespace App\Console\Commands;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Console\Command;

class CancelExpiredBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel pending bookings that were not paid within 15 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cancelledCount = Booking::where('status', BookingStatus::PENDING)
            ->where('created_at', '<=', now()->subMinutes(15))
            ->update(['status' => BookingStatus::CANCELLED]);

        $this->info("Successfully cancelled {$cancelledCount} expired booking(s).");
    }
}
