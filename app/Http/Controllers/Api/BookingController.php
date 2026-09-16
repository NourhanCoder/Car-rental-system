<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;

class BookingController extends Controller
{
    use ApiResponse;

    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function store(StoreBookingRequest $request): JsonResponse
    {
        try{
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;

            $booking = $this->bookingService->createBooking($data);

            return $this->successResponse(
                new BookingResource($booking),
                'Booking created successfully. Proceed to payment.',
                201
            );
        } catch (Exception $e){
            return $this->errorResponse($e->getMessage(), 422);
        }
    }
}
