<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Services\BookingService;
use App\Services\CarService;
use App\Services\TestimonialService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    protected CarService $carService;
    protected TestimonialService $testimonialService;
    protected BookingService $bookingService;

    public function __construct(CarService $carService, TestimonialService $testimonialService, BookingService $bookingService)
    {
        $this->carService = $carService;
        $this->testimonialService = $testimonialService;
        $this->bookingService = $bookingService;
    }

    public function index(Request $request): View
    {
        $cars = $this->carService->getPaginatedCars(6);
        $testimonials = $this->testimonialService->getLatestTestimonials(3);

        return view('main-website.listing', compact('cars', 'testimonials'));
    }

    public function show(Car $car): View
    {
        $car = $this->carService->getCarDetails($car);
        $bookedDates = $this->bookingService->getBookedDatesForCar($car->id);

        return view('main-website.single', compact('car', 'bookedDates'));
    }
}
