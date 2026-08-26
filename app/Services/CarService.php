<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Support\Collection;

class CarService
{
    protected ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function getAllCars(): Collection
    {
        return Car::with('category')->latest()->get();
    }

    public function getCarById(int $id): Car
    {
        return Car::findOrFail($id);
    }

    public function createCar(array $data): Car
    {
        if(isset($data['image'])){
            $data['image'] = $this->imageUploadService->uploadImage($data['image'], 'cars');
        }

        $data['is_active'] = isset($data['is_active']) ? true : false;

        return Car::create($data);
    }

    public function updateCar(int $id, array $data): Car
    {
        $car = $this->getCarById($id);

        if (isset($data['image'])){
            $data['image'] = $this->imageUploadService->uploadImage(
                $data['image'],
                'cars',
                $car->image 
            );
                
        }else{
            unset($data['image']);

        }

        $data['is_active'] = isset($data['is_active']) ? true : false;

        $car->update($data);
        return $car;
    }

    public function deleteCar(int $id): bool
    {
        $car = $this->getCarById($id);

        if ($car->image){
            $this->imageUploadService->deleteImage($car->image);
        }
        return $car->delete();
    }
}