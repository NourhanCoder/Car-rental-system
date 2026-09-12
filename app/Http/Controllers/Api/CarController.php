<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CarResource;
use App\Models\Car;
use App\Services\BookingService;
use App\Services\CarService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    use ApiResponse;

    protected CarService $carService;
    protected BookingService $bookingService;

    public function __construct(CarService $carService, BookingService $bookingService)
    {
        $this->carService = $carService;
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of active cars with optional category filtering & pagination.
    */
    public function index(Request $request): JsonResponse
    {
        $categoryIds = (array) $request->input('category_ids', []);

        $cars = $this->carService->getFilteredCars($categoryIds, 6);
        return $this->successResponse(
            CarResource::collection($cars)->response()->getData(true),
            'Cars retrieved successfully.'
        );
    }

    /**
     * Display details of a specific car including booked dates.
    */
    public function show(Car $car): JsonResponse
    {
        if (!$car->is_active){
            return $this->errorResponse('Car not found or unavailable.', 404);
        }

        $carDetails = $this->carService->getCarDetails($car);
        $bookedDates = $this->bookingService->getBookedDatesForCar($car->id);

        return $this->successResponse([
            'car' => new CarResource($carDetails),
            'booked_dates' => $bookedDates,
        ], 'Car details retrieved successfully.');
    }
}
