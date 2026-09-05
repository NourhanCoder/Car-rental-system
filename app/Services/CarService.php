<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarService
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }



    /**
     *  USER SIDE
     */

    //Get the latest active cars for the home page

    public function getFeaturedCars(int $limit = 6): Collection
    {
        return Car::with('category')
            ->where('is_active', true)->latest()
            ->take($limit)->get();
    }

    //for listing page to show only 6 cars for each page
    public function getPaginatedCars(int $perPage = 6)
    {
        return Car::where('is_active', true)->latest()->paginate($perPage);
    }

    //for single page 
    public function getCarDetails(Car $car): Car
    {
        if (!$car->is_active) {
            abort(404);
        }
        return $car;
    }

    /**
     * Get paginated active cars filtered by selected categories.
     */
    public function getFilteredCars(array $categoryIds = [], int $perPage = 6)
    {
        return Car::where('is_active', true)
            ->when(!empty($categoryIds), function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->latest()
            ->paginate($perPage);
    }



    /**
     *  ADMIN SIDE
     */
    public function getAllCars(): Collection
    {
        return Car::with('category')->latest()->get();
    }


    public function createCar(array $data): Car
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->uploadImage($data['image'], 'cars');
        }

        $data['is_active'] = isset($data['is_active']) ? true : false;

        return Car::create($data);
    }

    public function updateCar(Car $car, array $data): Car
    {
        if (isset($data['image'])) {
            $data['image'] = $this->imageUploadService->uploadImage(
                $data['image'],
                'cars',
                $car->image
            );
        } else {
            unset($data['image']);
        }

        $data['is_active'] = isset($data['is_active']) ? true : false;

        $car->update($data);
        return $car;
    }

    public function deleteCar(Car $car): bool
    {
        if ($car->image) {
            $this->imageUploadService->deleteImage($car->image);
        }
        return $car->delete();
    }
}
