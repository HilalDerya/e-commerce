<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(User $user): View
    {
        $products = Product::all()->where("is_active", true);
        $categories = Category::all()->where("is_active", true);

        return view("frontend.home.index", ["categories" => $categories, "products" => $products]);
    }
}
