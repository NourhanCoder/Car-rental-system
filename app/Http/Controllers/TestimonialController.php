<?php

namespace App\Http\Controllers;

use App\Services\TestimonialService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    protected TestimonialService $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function index(): View
    {
        $testimonials = $this->testimonialService->getPaginatedTestimonials(6);
        return view('main-website.testimonials', compact('testimonials'));
    }
}
