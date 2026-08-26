<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTestimonialRequest;
use App\Http\Requests\Admin\UpdateTestimonialRequest;
use App\Models\Testimonial;
use App\Services\TestimonialService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    protected TestimonialService $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function index()
    {
        $testimonials = $this->testimonialService->getAllTestimonials();
        return view('admin.testimonials.testimonials', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.addTestimonials');
    }

    public function store(StoreTestimonialRequest $request)
    {
        $this->testimonialService->store($request->validated());

        return redirect()->route('admin.testimonials.index')
        ->with('success', 'Testimonial created successfully!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.editTestimonials', compact('testimonial'));
    }

    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $this->testimonialService->update($testimonial, $request->validated());

        return redirect()->route('admin.testimonials.index')
        ->with('success', 'Testimonial updated successfully !');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->testimonialService->delete($testimonial);

        return redirect()->route('admin.testimonials.index')
        ->with('success', 'Testimonial deleted successfully !');
    }
}
