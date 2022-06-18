<?php

namespace App\Repositories\Product;

Interface ProductRepositoryInterface
{
    public function create($request);

    public function getAllProducts();

    public function getProductById($id);
}