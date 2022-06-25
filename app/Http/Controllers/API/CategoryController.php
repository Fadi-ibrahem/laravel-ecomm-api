<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\CategoryRepositoryInterface;
use App\Services\API\Category\StoreCategoryValidationService;
use App\Services\API\Category\UpdateCategoryValidationService;

class CategoryController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepo;

    /**
     * @param CategoryRepositoryInterface $categoryRepo
     */
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Categories using CategoryRepository
        $categories = $this->categoryRepo->index();

        // The response
        return response()->json(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreCategoryValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Create new category record using CategoryRepository
        $this->categoryRepo->create($request->all());

        // The response 
        return response()->json("Category Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // Response after model binding
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, UpdateCategoryValidationService $validator)
    {
        // Validate inputs using external service
        if($errors = $validator->isValid($request)) return response()->json($errors);
        
        // Update the specific category using CategoryRepository
        $this->categoryRepo->update($category, $request->all());

        // The response 
        return response()->json("Category Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Delete the specific category using CategoryRepository
        $this->categoryRepo->delete($category);

        // The response
        return response()->json("Category Deleted Successfully!");
    }
}
