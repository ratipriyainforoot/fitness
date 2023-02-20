<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function allOrders() {
        if(session()->has('admin')) {
            $orders = Order::paginate(10);
            return view('allOrders')->with(compact('orders'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }  
    }

    public function addOrders() {
        if(session()->has('admin')) {
            return view('addOrders');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        } 
    }

    public function addOrderStore(Request $request) {
        $order_id = $request->order_id;
        $user_id = $request->user_id;
        $user_address_id = $request->user_address_id;
        $product_id = $request->product_id;
        $nutrition_id = $request->nutrition_id;
        $nutrition_value_id = $request->nutrition_value_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $payment_method = $request->payment_method;
        Order::updateOrCreate(
            [
                'order_id' => $order_id,
                'user_id' => $user_id
            ],
            [
                'order_id' => $order_id,
                'user_id' => $user_id,
                'user_address_id' => $user_address_id,
                'product_id' => $product_id,
                'nutrition_id' => $nutrition_id,
                'nutrition_value_id' => $nutrition_value_id,
                'quantity' => $quantity,
                'price' => $price,
                'payment_method' => $payment_method,
                'dated' => Carbon::now('Asia/Kolkata')
            ]
        );
        return redirect()->route('all-orders')
        ->with('success','Orders Added');
    }
}
