<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;

class StateController extends Controller
{
    public function allState() {
        if(session()->has('admin')) {
            $states = State::paginate(10);
            return view('allState')->with(compact('states'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function stateList(Request $request) {
        if($request->has('country_id')) {
            $state = State::where('country_id',$request->country_id)->get();
        }else {
            $state = State::get();
        }
        if($state->count() > 0) {
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'State List',
                    'data' => $state
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'State List not available',
                    'data' => $state
                ]
            );
        }
        
    }

    public function addState() {
        if(session()->has('admin')) {
            return view('addState');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function addStateStore(Request $request) {
        $country_id = $request->country_id;
        $state = $request->name;
        State::updateOrCreate(
            [
                'name' => $state,
            ],
            [
                'country_id' => $country_id,
                'name' => $state,
            ]
        );
        return redirect()->route('all-state')
        ->with('success','State added');
    }

    public function editState(Request $request) {
        $country_id = $request->country_id;
        $name = $request->name;
        $id = $request->id;
        State::where('id',$id)->update(
            [
                'country_id' => $request->country_id,
                'name' => $name
            ]
        );
        return redirect()->route('all-state')
        ->with('success','State updated');
    }

    public function deleteState(Request $request) {
        $id = $request->id;
        State::where('id',$id)->delete();
        City::where('state_id',$id)->delete();
        return redirect()->route('all-state')
        ->with('success','State deleted');
    }
}
