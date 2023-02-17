<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function addBanner() {
        if(session()->has('admin')) {
            return view('addBanner');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addBannerStore(Request $request) {
        $title = $request->title;
        $banner = $request->file('banner');
        $bannerName = time().$banner->getClientOriginalName();
        $banner = $banner->move('banner',$bannerName);
        Banner::updateOrCreate(
            [
                'title' => $title
            ],
            [
                'image' => $banner,
                'title' => $title
            ]
        );
        return redirect()->route('all-banner');
    }

    public function allBanner() {
        if(session()->has('admin')) {
            $banners = Banner::paginate(10);
            return view('allBanner')->with(compact('banners'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }
}
