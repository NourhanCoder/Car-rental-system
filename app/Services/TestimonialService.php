<?php

namespace App\Services;

use App\Models\Testimonial;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TestimonialService
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }



    /**
     * USER SIDE
     */

     
      //Get the latest published reviews for the home page
    public function getLatestTestimonials(int $limit = 3): Collection
    {
        return Testimonial::with('user')
            ->where('is_published', true)->latest()
            ->take($limit)->get();
    }

    //Get available testimonials for testimonials page
    public function getPaginatedTestimonials(int $perPage = 6): LengthAwarePaginator
    {
        return Testimonial::where('is_published', true)
        ->latest()->paginate($perPage);
    }



     /**
     * ADMIN SIDE
     */
    public function getAllTestimonials(): Collection
    {
        return Testimonial::with('user')->latest()->get();
    }


   

    public function store(array $data): Testimonial
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->uploadImage($data['image'], 'testimonials');
        }

        $data['is_published'] = isset($data['is_published']) ? true : false;

        return Testimonial::create($data);
    }

    public function update(Testimonial $testimonial, array $data): bool
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->uploadImage(
                $data['image'],
                'testimonials',
                $testimonial->image
            );
        } else {
            unset($data['image']);
        }

        $data['is_published'] = isset($data['is_published']) ? true : false;

        return $testimonial->update($data);
    }

    public function delete(Testimonial $testimonial): bool
    {
        if ($testimonial->image) {
            $this->imageUploadService->deleteImage($testimonial->image);
        }

        return $testimonial->delete();
    }
}
