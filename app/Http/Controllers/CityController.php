<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function allCity() {
        if(session()->has('admin')) {
            $cities = City::paginate(10);
            return view('allCity')->with(compact('cities'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function cityList(Request $request) {
        if($request->has('state_id')) {
            $city = City::where('state_id',$request->state_id)->get();
        }else {
            $city = City::get();
        }
        if($city->count() > 0) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'City List',
                    'data' => $city
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'City List not available',
                    'data' => $city
                ]
            );
        }
        
    }

    public function addCity() {
        if(session()->has('admin')) {
            return view('addCity');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addCityStore(Request $request) {
        $state_id = $request->state_id;
        $city = $request->name;
        City::updateOrCreate(
            [
                'name' => $city,
            ],
            [
                'state_id' => $state_id,
                'name' => $city,
            ]
        );
        return redirect()->route('all-city')
        ->with('success','City added');
    }

    public function editCity(Request $request) {
        $state_id = $request->state_id;
        $name = $request->name;
        $id = $request->id;
        City::where('id',$id)->update(
            [
                'state_id' => $request->state_id,
                'name' => $name
            ]
        );
        return redirect()->route('all-city')
        ->with('success','City updated');
    }

    public function deleteCity(Request $request) {
        $id = $request->id;
        City::where('id',$id)->delete();
        return redirect()->route('all-city')
        ->with('success','City deleted');
    }
}
