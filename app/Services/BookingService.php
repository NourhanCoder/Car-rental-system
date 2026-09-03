<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Calculate the total price based on the number of days and the car's daily rate.
     */

    public function calculateTotalPrice(Car $car, string $pickUpDate, string $dropOffDate): float
    {
        $start = Carbon::parse($pickUpDate);
        $end = Carbon::parse($dropOffDate);

        // Calculate the number of days (ensuring at least one day)
        $days = max(1, $start->diffInDays($end));
        return $days * $car->active_price;
    }

    /**
     * Check car availability and create a safe booking to prevent race conditions
     */

    public function createBooking(array $data): Booking
    {
        return DB::transaction(function () use ($data) {

            // 1. Lock the car to prevent booking conflicts (Pessimistic Locking)
            $car = Car::lockForUpdate()->findOrFail($data['car_id']);


            $pendingStatus   = BookingStatus::PENDING->value;
            $confirmedStatus = BookingStatus::CONFIRMED->value;


            // 2. Check that the car is not already booked for the same period (Nested Clauses)
            $hasConflict = Booking::where('car_id', $car->id)
                ->whereIn('status', [$pendingStatus, $confirmedStatus])
                ->where(function ($query) use ($data) {
                    $query->whereBetween('pick_up_date', [$data['pick_up_date'], $data['drop_off_date']])
                        ->orWhereBetween('drop_off_date', [$data['pick_up_date'], $data['drop_off_date']])
                        ->orWhere(function ($q) use ($data) {
                            $q->where('pick_up_date', '<=', $data['pick_up_date'])
                                ->where('drop_off_date', '>=', $data['drop_off_date']);
                        });
                })
                ->exists();

            if ($hasConflict) {
                throw new Exception('Sorry, this car is already booked for the selected dates.');
            }

            //3. Calculate total price
            $totalPrice = $this->calculateTotalPrice($car, $data['pick_up_date'], $data['drop_off_date']);

            // 4. Create the booking with status pending
            return Booking::create([
                'user_id' => $data['user_id'],
                'car_id' => $car->id,
                'pick_up_date' => $data['pick_up_date'],
                'drop_off_date' => $data['drop_off_date'],
                'total_price' => $totalPrice,
                'status' => $pendingStatus,
            ]);
        });
    }

    /**
     *  Disable booked days to prevent double booking
     */

    public function getBookedDatesForCar(int $carId): array
    {
        return Booking::where('car_id', $carId)
            ->where('status', '!=', BookingStatus::CANCELLED->value)
            ->get(['pick_up_date', 'drop_off_date'])
            ->map(function ($booking) {
                return [
                    'from' => Carbon::parse($booking->pick_up_date)->format('Y-m-d'),
                    'to'   => Carbon::parse($booking->drop_off_date)->format('Y-m-d'),
                ];
            })
            ->toArray();
    }
}
