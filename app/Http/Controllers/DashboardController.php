<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();

        // fetch all user bookings with cars
        $userBookings = $user->bookings()->with('car')->latest()->get();

        // 1. Acrtive bookings
        $activeBookingsCount = $userBookings->filter(function ($booking) {
            return $booking->status === BookingStatus::CONFIRMED 
                && $booking->drop_off_date->isFuture();
        })->count();

        // 2. Completed bookings
        $completedBookingsCount = $userBookings->filter(function ($booking) {
            return $booking->status === BookingStatus::COMPLETED 
                || ($booking->status === BookingStatus::CONFIRMED && $booking->drop_off_date->isPast());
        })->count();

        return view('dashboard', compact('userBookings', 'activeBookingsCount', 'completedBookingsCount'));
    }
}
