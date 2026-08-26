<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


class CategoryService
{
    public function getAllCategories(): Collection
    {
        return Category::latest()->get();
    }

    public function getCategoryById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function createCategory(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }

    public function updateCategory(int $id, array $data): Category
    {
        $category = $this->getCategoryById($id);
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return $category;
    }

    public function deleteCategory(int $id): bool
    {
        $category = $this->getCategoryById($id);
        return $category->delete();
    }
}