<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Event;
class EventController extends Controller
{
    public function index(Request $request){
        $products = Product::where('store_id', $request->store_id)->get();
        $events=Event::where('store_id',$request->store_id)->get();
        return view('storeevent', ['storeid' => $request->store_id, 'products' => $products,'events'=>$events]);
	}
    public function addevent(Request $request){

        $request->validate([
            'store_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'product_id' => 'required|integer',
            'starting_price' => 'required|numeric|min:0'
        ]);


        $event=new Event();
        $event->store_id=$request->store_id;
        $event->name=$request->name;
        $event->description=$request->description;
        $event->start_date=$request->start_date;
        $event->end_date=$request->end_date;
        $event->product_id=$request->product_id;
        $event->starting_price=$request->starting_price;
        $event->current_price=$request->starting_price;
        $event->save();
        return redirect()->route('view-edit-store', ['store_id'=>$request->store_id]);

    }

    public function getEvents($storeId){
        $events=Event::with('store')->where('store_id',$storeId)->get();

        return $events;
    }
}
