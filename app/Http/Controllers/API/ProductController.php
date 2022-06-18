<?php

namespace App\Http\Controllers\API;

use App\Dtos\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->middleware('auth:api');

        $this->productRepository = $product;
    }

    public function create(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->only([
            'name', 'quantity'
        ]));
        $product = ProductDTO::make($product);

        return response()->json([
            'message' => 'Product successfully added',
            'product' => $product->name
        ], Response::HTTP_CREATED);
    }

    public function getProducts()
    {
        $products = $this->productRepository->getAllProducts();

        return response()->json($products, Response::HTTP_OK);
    }
    
    public function getProductInfo(Product $product)
    {
        $product = $this->productRepository->getProductById($product->id);

        return response()->json($product, Response::HTTP_OK);
    }
}
