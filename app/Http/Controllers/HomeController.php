<?php

namespace App\Http\Controllers;

use App\Services\CarService;
use App\Services\TestimonialService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
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
        $cars = $this->carService->getFeaturedCars(6);
        $testimonials = $this->testimonialService->getLatestTestimonials(3);

        return view('main-website.index', compact('cars', 'testimonials'));
    }
}
