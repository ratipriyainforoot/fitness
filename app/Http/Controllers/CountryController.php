<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;

class CountryController extends Controller
{
    public function allCountry() {
        if(session()->has('admin')) {
            $countries = Country::paginate(10);
            return view('allCountry')->with(compact('countries'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function countryList(Request $request) {
        $country = Country::get();
        if($country->count() > 0) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Country List',
                    'data' => $country
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Country List not available',
                    'data' => $country
                ]
            );
        }
        
    }

    public function addCountry() {
        if(session()->has('admin')) {
            return view('addCountry');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addCountryStore(Request $request) {
        $country = $request->name;
        Country::updateOrCreate(
            [
                'name' => $country,
            ],
            [
                'name' => $country,
            ]
        );
        return redirect()->route('all-country')
        ->with('success','Country added');
    }

    public function editCountry(Request $request) {
        $name = $request->name;
        $id = $request->id;
        Country::where('id',$id)->update(
            [
                'name' => $name
            ]
        );
        return redirect()->route('all-country')
        ->with('success','Country updated');
    }

    public function deleteCountry(Request $request) {
        $id = $request->id;
        Country::where('id',$id)->delete();
        State::where('country_id',$id)->delete();
        return redirect()->route('all-country')
        ->with('success','Country deleted');
    }
}
