<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Event;
class EventController extends Controller
{
    public function index($storeid){
        $products = Product::where('store_id', $storeid)->get();
        $events=Event::where('store_id',$storeid)->get();
        return view('storeevent', ['storeid' => $storeid, 'products' => $products,'events'=>$events]);
	}
    public function addevent(Request $request){
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
        return redirect()->route('indexevent', ['storeid' => $request->store_id]);

    }
}
