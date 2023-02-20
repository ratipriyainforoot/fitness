<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function allCategory() {
        if(session()->has('admin')) {
            $categories = Category::paginate(10);
            return view('allCategory')->with(compact('categories'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addCategory() {
        if(session()->has('admin')) {
            return view('addCategory');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addCategoryStore(Request $request) {
        $title = $request->title;
        $title_ar = $request->title_ar;
        Category::updateOrCreate(
            [
                'title' => $title,
                'title_ar' => $title_ar
            ],
            [
                'title' => $title,
                'title_ar' => $title_ar
            ]
        );
        return redirect()->route('all-category')
            ->with('success','Category added');
    }

    public function editCategory(Request $request) {
        $id = $request->id;
        $title = $request->title;
        $title_ar = $request->title_ar;
        Category::where('id',$id)
        ->update(
            [
                'title' => $title,
                'title_ar' => $title_ar
            ]
        );
        return redirect()->route('all-category')
            ->with('success','Category updated');
    }

    public function deleteCategory(Request $request) {
        $id = $request->id;
        Category::where('id',$id)->delete();
        return redirect()->route('all-category')
            ->with('success','Category deleted');
    }
}
