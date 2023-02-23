<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function allCoupon() {
        if(session()->has('admin')) {
            $coupons = Coupon::paginate(10);
            return view('allCoupon')->with(compact('coupons'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addCoupon() {
        if(session()->has('admin')) {
            return view('addCoupon');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addCouponStore(Request $request) {
        $coupon_code = $request->coupon_code;
        $type = $request->type;
        $value = $request->value;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        Coupon::updateOrCreate(
            [
                'coupon_code' => $coupon_code,
            ],
            [
                'coupon_code' => $coupon_code,
                'type' => $type,
                'value' => $value,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]
        );
        return redirect()->route('all-coupon')
            ->with('success','Coupon added');
    }

    public function editCoupon(Request $request) {
        $id = $request->id;
        $coupon_code = $request->coupon_code;
        $type = $request->type;
        $value = $request->value;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        Coupon::where('id',$id)
        ->update(
            [
                'coupon_code' => $coupon_code,
                'type' => $type,
                'value' => $value,
                'start_date' => $start_date,
                'end_date' => $end_date
            ]
        );
        return redirect()->route('all-coupon')
            ->with('success','Coupon updated');
    }

    public function deleteCoupon(Request $request) {
        $id = $request->id;
        Coupon::where('id',$id)->delete();
        return redirect()->route('all-coupon')
            ->with('success','Coupon deleted');
    }
}
