<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        return view('shop.index')->with([
            'products' => $products,
        ]);
    }

    public function show(Product $product){
        return view('shop.show')->with([
            'product'=>$product,
        ]);
    }
}
