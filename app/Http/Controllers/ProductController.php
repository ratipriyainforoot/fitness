<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
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
    
    public function ProductList(Request $request) {
        $language = $request->language;
        $categories = Category::all();
        $data = [];
        foreach ($categories as $category) {
            if($language == 1) {
                $category_name = $category->title;
            }else {
                $category_name = $category->title_ar;
            }
            $products = Product::where('category_id',$category->id)->get();
            $productData = [];
            foreach ($products as $product) {
                if($language == 1) {
                    $product_name = $product->product_name;
                    $description = $product->description;
                }else {
                    $product_name = $product->product_name_ar;
                    $description = $product->description_ar;
                }
                $nutrition_list = [];
                $nutrition_value_list = [];
                for ($i=0; $i < count(json_decode($product->nutrition_id)); $i++) { 
                    if(strpos(json_decode($product->nutrition_value)[$i],',')) {
                        $nutrition_value_array = explode(',',json_decode($product->nutrition_value)[$i]);
                    }else {
                        $nutrition_value_array = [
                            'nutition_value' => json_decode($product->nutrition_value)[$i]
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
                        'nutrition_name' => json_decode($product->nutrition_id)[$i],
                        'nutrition_value' => $new_array
                    ];
                }
                $productData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product_name,
                    'nutrition_id' => $nutrition_list,
                    'meals' => $product->meals,
                    'snacks' => $product->snacks,
                    'description' => $description,
                    'price' => $product->price,
                    'image' => 'https://inforootsolution.com/fitnessway/public/'.$product->image,
                ];
            }
            $data[] = [
                'category_id' => $category->id,
                'category_name' => $category_name,
                'product_data' => $productData
            ];
        }
        return response()->json(
            [
                'code' => 1,
                'message' => 'Product Lists',
                'data' => $data
            ],
            200
        );
    }
    
    public function product_details(Request $request) {
        $language = $request->language;
        $product_id = $request->product_id;
        $product_details = [];
        $product = Product::where('id',$product_id)->first();
        $nutrition_list = [];
        $nutrition_value_list = [];
        for ($i=0; $i < count(json_decode($product->nutrition_id)); $i++) { 
            if(strpos(json_decode($product->nutrition_value)[$i],',')) {
                $nutrition_value_array = explode(',',json_decode($product->nutrition_value)[$i]);
            }else {
                $nutrition_value_array = [
                    'nutition_value' => json_decode($product->nutrition_value)[$i]
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
                'nutrition_name' => json_decode($product->nutrition_id)[$i],
                'nutrition_value' => $new_array
            ];
        }
        if($language == 1) {
            $product_details = [
                'product_id' => $product->id,
                'product_image' => 'https://inforootsolution.com/fitnessway/public/'.$product->image,
                'product_name' => $product->product_name,
                'about_product' => $product->description,
                'meals' => $product->meals,
                'snacks' => $product->snacks,
                'price' => $product->price,
                'nutrition_list' => $nutrition_list
            ];
        }

        if($language == 2) {
            $product_details = [
                'product_id' => $product->id,
                'product_image' => 'https://inforootsolution.com/fitnessway/public/'.$product->image,
                'product_name' => $product->product_name_ar,
                'about_product' => $product->description_ar,
                'meals' => $product->meals,
                'snacks' => $product->snacks,
                'price' => $product->price,
                'nutrition_list' => $nutrition_list
            ];
        }

        return response()->json(
            [
                'code' => 1,
                'message' => 'Product Details available',
                'data' => $product_details
            ]
        );
        
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
