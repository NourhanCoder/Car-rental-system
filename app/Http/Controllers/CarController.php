<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Services\CarService;
use App\Services\TestimonialService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarController extends Controller
{
    protected CarService $carService;
    protected TestimonialService $testimonialService;

    public function __construct(CarService $carService, TestimonialService $testimonialService)
    {
        $this->carService = $carService;
        $this->testimonialService = $testimonialService;
    }

    public function index(): View
    {
        $cars = $this->carService->getPaginatedCars(6);
        $testimonials = $this->testimonialService->getLatestTestimonials(3);

        return view('main-website.listing', compact('cars', 'testimonials'));
    }

    public function show(Car $car): View
    {
        $car = $this->carService->getCarDetails($car);

        return view('main-website.single', compact('car'));
    }
}
