<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\DogService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        // var_dump(session('cartItems'));
        // foreach (session('cartItems') as $key => $value) {
        //     echo '<br>';
        //     var_dump($key, $value);
        // }
        // dd(session('cartItems'));
        $dogService = new DogService();

        $dogBreeds = $dogService->getBreeds();

        return view('cart.cart')->with([
            'dogs' => $dogBreeds['data'],
        ]);
    }

    public function addToCart(Product $product)
    {
        $cartItems = session()->get('cartItems', []);

        if(isset($cartItems[$product->id])) {
            $cartItems[$product->id]['quantity']++;
        } else {
            $cartItems[$product->id] = [
                "image_path" => $product->image_path,
                "name" => $product->name,
                "brand" => $product->brand,
                "details" => $product->details,
                "price" => $product->price,
                "quantity" => 1,
            ];
        }

        session()->put('cartItems', $cartItems);
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function delete(Product $product)
    {
        if($product) {
            $cartItems = session()->get('cartItems');

            if(isset($cartItems[$product->id])) {
                unset($cartItems[$product->id]); 
                session()->put('cartItems', $cartItems);
            }

            return redirect()->back()->with('success', 'Product deleted successfully');
        }
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cartItems = session()->get('cartItems');
            $cartItems[$request->id]["quantity"] = $request->quantity;
            var_dump($cartItems);
            session()->put('cartItems', $cartItems);
            session()->flash('success', 'Cart updated successfully');
            
        }
        return redirect()->back();
    }
}
