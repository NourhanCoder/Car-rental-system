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


    public function createCategory(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}