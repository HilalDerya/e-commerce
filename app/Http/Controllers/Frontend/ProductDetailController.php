<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductDetailController extends Controller
{
    public function index(Product $product): View
    {
        //$products = Product::all()->where("is_active", true);
        return view("frontend.productDetail.index", ["product" => $product]);
    }
}