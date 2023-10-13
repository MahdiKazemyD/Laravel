<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    protected object $productService;

    public function __construct(productService $productService)
    {
        $this->productService    = $productService;
    }

    public function index()
    {
        $product = Product::with('category' , 'media')->get();
        return ProductResource::collection($product);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request);
        return new ProductResource($product);
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $product = $this->productService->update($product, $request);
        return new ProductResource($product);
    }

    public function destroy(Product $product) : mixed
    {
        return $this->productService->destroy($product);
    }
}
