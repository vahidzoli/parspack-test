<?php

namespace App\Repositories\Product;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function create($request)
    {
        return $this->productModel->create($request);
    }

    public function getAllProducts()
    {
        return $this->productModel->with('comments')->get();
    }

    public function getProductById($id)
    {
        return $this->productModel->with('comments')->findOrFail($id);
    }
}