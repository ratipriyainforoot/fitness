<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        //$nutrition_id = $request->nutrition_id;
        //$nutrition_value_id = $request->nutrition_value_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $payment_method = $request->payment_method;
        $attributes = DB::table('nutritional_items')->get();
        $attribute_array = [];
        $attribute_value_array = [];
        foreach($attributes as $attribute) {
            $attribute_name = $attribute->nutrition;
            $attribute_value = $attribute_name.'Value';
            if(isset($request->$attribute_name) != null) {
                array_push($attribute_array,$attribute->nutrition);
                array_push($attribute_value_array,$request->$attribute_value);
            }
        }
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
                'nutrition_id' => json_encode($attribute_array),
                'nutrition_value_id' => json_encode($attribute_value_array),
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
