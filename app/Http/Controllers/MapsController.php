<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class MapsController extends Controller
{
    public function mapShow()
    {
        return view('maps.show');
    }


    public function saveLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        $location = new Location();
    
        $location->user_id = $user->user_id ;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        
        $location->save();

        return redirect()->back()->with('success', 'Location saved successfully');
    }
    
    
}
