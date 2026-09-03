<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    //Dependency Injection
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    // Create the booking and proceed to payment
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        // 1. Merge the incoming data and add the current user's ID
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        // 2. Call the service to validate and create the booking
        $booking = $this->bookingService->createBooking($data);

        // 3. Redirect to the payment page and pass the booking ID
        return redirect()->route('payment.checkout', $booking);
    }
}
