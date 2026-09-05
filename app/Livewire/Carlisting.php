<?php

namespace App\Livewire;

use App\Services\CarService;
use App\Services\CategoryService;
use Livewire\Component;
use Livewire\WithPagination;

class Carlisting extends Component
{
    use WithPagination;

    // Use Bootstrap pagination to match template styling
    protected string $paginationTheme = 'bootstrap';

    // Array to store selected category IDs from checkboxes
    public array $selectedCategories = [];

    //Reset pagination to page 1 automatically when any category changes
    public function updatingSelectedCategories(): void
    {
        $this->resetPage();
    }

    public function render(CarService $carService, CategoryService $categoryService)
    {
        // Fetch filtered cars based on the selected array
        $cars = $carService->getFilteredCars($this->selectedCategories, 6);

        // Fetch all active categories to display in the sidebar
        $categories = $categoryService->getAllCategories();
        return view('livewire.carlisting', [
            'cars' => $cars,
            'categories' => $categories,
        ]);
    }
}
