<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Routing\Controller;


class CategoryController extends Controller
{
    protected object $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService    = $categoryService;
    }

    public function index()
    {
        $category = Category::with('parent', 'children')->get();
        return CategoryResource::collection($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $this->categoryService->create($request);
        return new CategoryResource($data);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $data = $this->categoryService->update($category,$request);
        return new CategoryResource($data);
    }

    public function destroy(Category $category)
    {
       return $this->categoryService->destroy($category);
    }
}
