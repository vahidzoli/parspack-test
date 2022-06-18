<?php

namespace App\Http\Controllers\API;

use App\Dtos\ProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->middleware('auth:api');

        $this->productRepository = $product;
    }

    /**
     * Create a product.
     *
     * @param  ProductRequest  $request
     * 
     * @return json
     */
    public function create(ProductRequest $request): JsonResponse
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

    /**
     * Show all products.
     * 
     * @return json
     */
    public function getProducts(): JsonResponse
    {
        $products = $this->productRepository->getAllProducts();

        return response()->json($products, Response::HTTP_OK);
    }
    
    /**
     * Get a product info.
     *
     * @param  Product  $product
     * 
     * @return json
     */
    public function getProductInfo(Product $product): JsonResponse
    {
        $product = $this->productRepository->getProductById($product->id);

        return response()->json($product, Response::HTTP_OK);
    }
}
