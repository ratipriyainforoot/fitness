<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Country;
use App\Models\State;
use App\Models\City;



class AddressController extends Controller
{
    public function AddUserAddress(Request $request) {
        $user_id = $request->user_id;
        $country_id = $request->country_id;
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        $area = $request->area;
        $block = $request->block;
        $street = $request->street;
        $avenue = $request->avenue;
        $house = $request->house;
        $floor = $request->floor;
        $apartment = $request->apartment;
        $add_address = Address::updateOrCreate(
            [
                'user_id' => $request->user_id,
            ],
            [
                'user_id' => $request->user_id,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'area' => $request->area,
                'block' => $request->block,
                'street' => $request->street,
                'avenue' => $request->avenue,
                'house' => $request->house,
                'floor' => $request->floor,
                'apartment' => $request->apartment,
            ]
        );
        if($add_address) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Address added sucessfully'
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'unable to add address'
                ]
            );
        }
    }
    
    public function MyAddressList(Request $request) {
        $user_id = $request->user_id;
        $addressExists = Address::where('user_id',$user_id)->exists();
        if($addressExists) {
            $address = Address::where('user_id',$user_id)->get();
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Address List Available.',
                    'data' => $address
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'No data found',
                    'data' => ''
                ]
            );
        }
    }

    public function getCurrentAddress(Request $request) {
        $user_id = $request->user_id;
        $addressExists = Address::where('user_id',$user_id)->exists();
        $data = [];
        if($addressExists) {
            $address = Address::where('user_id',$user_id)->orderBy('id','DESC')->first();
            $country = Country::where('id',$address->country_id)->first();
            $state = State::where('id',$address->state_id)->first();
            $city = City::where('id',$address->city_id)->first();
            $data[] = [
                'id' => $address->id,
                'user_id' => $address->user_id,
                'country' => $country->name,
                'state' => $state->name,
                'city' => $city->name,
                'area' => $address->area,
                'block' => $address->block,
                'street' => $address->street,
                'avenue' => $address->avenue,
                'house' => $address->house,
                'floor' => $address->floor,
                'apartment' => $address->apartment,
            ];
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Address List Available.',
                    'data' => $data
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'No data found',
                    'data' => ''
                ]
            );
        }
    }
}
