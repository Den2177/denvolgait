<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(
                [
                    'error' => [
                        'message' => 'product not found',
                    ]
                ], 404
            );
        }

        return new ProductResource($product);

    }
}
