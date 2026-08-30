<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarRequest;
use App\Http\Requests\Admin\UpdateCarRequest;
use App\Models\Car;
use App\Services\CarService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected CarService $carService;
    protected CategoryService $categoryService;

    public function __construct(CarService $carService, CategoryService $categoryService)
    {
        $this->carService = $carService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $cars = $this->carService->getAllCars();
        return view('admin.cars.cars', compact('cars'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.cars.addCar', compact('categories'));
    }

    public function store(StoreCarRequest $request)
    {
        $this->carService->createCar($request->validated());
        return redirect()->route('admin.cars.index')
        ->with('success', 'Car created successfully!');
    }

    public function edit(Car $car)
    {
       $categories = $this->categoryService->getAllCategories();

       return view('admin.cars.editCar', compact('car', 'categories'));
    }

    public function update(UpdateCarRequest $request, Car $car)
    {
       $this->carService->updateCar($car, $request->validated());
       return redirect()->route('admin.cars.index')
       ->with('success', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        $this->carService->deleteCar($car);
        return redirect()->route('admin.cars.index')
        ->with('success', 'Car deleted successfully!');
    }
}
