<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function allProducts() {
        if(session()->has('admin')) {
            $banners = Banner::paginate(10);
            return view('allProduct')->with(compact('banners'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addProduct(Request $request) {
        if(session()->has('admin')) {
            return view('addProduct');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addProductStore(Request $request) {
        $category_id = $request->category_id;
        $product_name = $request->product_name;
        $product_name_ar = $request->product_name_ar;
        $meals = $request->meals;
        $snacks = $request->snacks;
        $description = $request->description;
        $description_ar = $request->description_ar;
        $price = $request->price;
        $attributes = DB::table('nutritional_items')->get();
        $attribute_array = [];
        $attribute_value_array = [];
        foreach($attributes as $attribute) {
            $attribute_name = $attribute->nutrition;
            $attribute_value = $attribute_name.'Value';
            if(isset($request->$attribute_name) != null) {
                array_push($attribute_array,$attribute_name);
                array_push($attribute_value_array,$request->$attribute_value);
            }
        }
        $banner = $request->file('banner');
            $bannerName = time().$banner->getClientOriginalName();
            $banner = $banner->move('banner',$bannerName);
            Product::updateOrCreate(
                [
                    'category_id' => $category_id,
                    'product_name' => $product_name,
                    'product_name_ar' => $product_name_ar
                ],
                [
                    'category_id' => $category_id,
                    'product_name' => $product_name,
                    'product_name_ar' => $product_name_ar,
                    'meals' => $meals,
                    'snacks' => $snacks,
                    'description' => $description,
                    'description_ar' => $description_ar,
                    'price' => $price,
                    'nutrition_id' => json_encode($attribute_array),
                    'nutrition_value' => json_encode($attribute_value_array),
                    'image' => $banner
                ]
            );
        return redirect()->route('all-products');
    }
}
