<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductPreviewResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return  ProductPreviewResource::collection(
            Product::when($request->has('search'), function ($query) use ($request) {
                $search = $request->input('search');
                return $query->where('name', 'like', "%{$search}%");
            })->paginate(10)
        );
    }
}
