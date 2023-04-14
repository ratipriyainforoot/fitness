<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request) {
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $nutrition_id = $request->nutrition_id;
        $nutrition_value_id = $request->nutrition_value_id;
        $quantity = $request->quantity;
        $product = \App\Models\Product::where('id',$product_id)->first();
        $price = ($product->price) * $quantity;
        $cart = Cart::insert(
            [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'nutrition_id' => $nutrition_id,
                'nutrition_value_id' => $nutrition_value_id,
                'price' => $price,
                'quantity' => $quantity,
                'dated' => \Carbon\Carbon::now('Asia/Kolkata')->format('Y-m-d'),
            ]
        );
        if($cart) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Cart added successfully',
                    'data' => ''
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Unable to add cart',
                    'data' => ''
                ]
            );
        }

    }
    
    public function MyCartList(Request $request) {
        $user_id = $request->user_id;
        $cartExists = Cart::where('user_id',$user_id)->exists();
        if($cartExists) {
            $carts = Cart::where('user_id',$user_id)->get();
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Cart List Available',
                    'data' => $carts
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Cart List Not Available',
                    'data' => ''
                ]
            );
        }
        
    }
}
