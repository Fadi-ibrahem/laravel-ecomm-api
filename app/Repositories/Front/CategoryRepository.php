<?php

namespace App\Repositories\Front;

use App\Filters\Category\CategoryNameFilter;
use App\Models\Category;
use Illuminate\Pipeline\Pipeline;
use App\Interfaces\Front\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function index()
    {
        $categories = app(Pipeline::class)
            ->send(Category::query())
            ->through([
                CategoryNameFilter::class,
            ])
            ->thenReturn()
            ->paginate(12);

        return $categories;
    }

    public function create(Array $data)
    {
        Category::create($data);
    }

    public function update(Category $category, Array $data)
    {
        $category->update($data);
    }

    public function delete(Category $category)
    {
        $category->delete();
    }

    public function show(Category $category)
    {
        return $category;
    }

}
