<?php

namespace App\Interfaces\Front;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function index();

    public function create(Array $data);

    public function update(Category $category, Array $data);

    public function delete(Category $category);

    public function show(Category $category);
}
