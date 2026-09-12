<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CarResource;
use App\Http\Resources\Api\TestimonialResource;
use App\Services\CarService;
use App\Services\TestimonialService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponse;

    protected CarService $carService;
    protected TestimonialService $testimonialService;

    public function __construct(CarService $carService, TestimonialService $testimonialService)
    {
        $this->carService = $carService;
        $this->testimonialService = $testimonialService;
    }

    public function index(): JsonResponse
    {
        $cars = $this->carService->getFeaturedCars(6);
        $testimonials = $this->testimonialService->getLatestTestimonials(3);

        return $this->successResponse([
            'featured_cars' => CarResource::collection($cars),
            'testimonials' => TestimonialResource::collection($testimonials),
        ], 'Home page data retrieved successfully.');
    }
}
