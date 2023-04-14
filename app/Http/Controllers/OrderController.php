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

    public function placeOrder(Request $request) {
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $nutrition_id = $request->nutrition_id;
        $nutrition_value_id = $request->nutrition_value_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $payment_method = $request->payment_method;
        $dated = $request->dated;
        $note = $request->note;
        $door_to_door = $request->door_to_door;
        $coupon_id = $request->coupon_id;
        $address_id = $request->address_id;
        $transaction_id = $request->transaction_id;
        $payment_status = $request->payment_status;
        $order = Order::create(
            [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'nutrition_id' => $nutrition_id,
                'nutrition_value_id' => $nutrition_value_id,
                'quantity' => $quantity,
                'price' => $price,
                'payment_method' => $payment_method,
                'dated' => $dated,
                'note' => $note,
                'door_to_door' => $door_to_door,
                'coupon_id' => $coupon_id,
                'address_id' => $address_id,
                'transaction_id' => $transaction_id,
                'payment_status' => $payment_status
            ]
        );
        return response()->json(
            [
                'code' => 1,
                'message' => 'Order placed',
                'data' => $order
            ]
        );
    }

    public function orderList(Request $request) {
        $user_id = $request->user_id;
        $product_details = [];
        $orders = Order::where('user_id',$user_id)->get();
        $nutrition_list = [];
        $nutrition_value_list = [];
        // return response()->json(
        //     [
        //         'code' => 1,
        //         'message' => 'Order List',
        //         'data' => $orders
        //     ]
        // );
         foreach ($orders as $order) {
                for ($i=0; $i < count(json_decode($order->nutrition_id)); $i++) { 
                    if(strpos(json_decode($order->nutrition_value_id)[$i],',')) {
                        $nutrition_value_array = explode(',',json_decode($order->nutrition_value_id)[$i]);
                        
                    }else {
                        $nutrition_value_array = [
                            'nutition_value' => json_decode($order->nutrition_value_id)[$i]
                        ];
                    }
                    $nutrition_value_list = $nutrition_value_array;
                    $nutrition_value_objects = (object) $nutrition_value_list;
                    $new_array = [];
                    foreach ($nutrition_value_objects as $value) {
                    $new_array[] = ['nutrition_value' => $value];
                    }
                    foreach ($nutrition_value_objects as $key => $nutrition_value_object) {
                        $nutrition_value_list['nutrition_value'] = [
                            'nutrition_value' => $nutrition_value_object
                        ];
                    }
                    $nutrition_list[] = [
                        'nutrition_name' => json_decode($order->nutrition_id)[$i],
                        'nutrition_value' => $new_array
                    ];
                }
            $product_details[] = [
                "id"=> $order->id,
                "user_id" => $order->user_id,
                "product_id" => $order->product_id,
                "nutrition_list" => $nutrition_list,
                "quantity" => $order->quantity,
                "price" => $order->price,
                "payment_method" => $order->payment_method,
                "dated" => $order->dated,
                "note" => $order->note,
                "door_to_door" => $order->door_to_door,
                "coupon_id" => $order->coupon_id,
                "address_id" => $order->address_id,
                "transaction_id" => $order->transaction_id,
                "payment_status" => $order->payment_status
            ];
         }
        return response()->json(
            [
                'code' => 1,
                'message' => 'Order List',
                'data' => $product_details
            ]
        );
    }
}
