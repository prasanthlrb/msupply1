<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\location;
use App\location_management;
use App\product;

class locationController extends Controller
{
    public function locationList()
    {
        $loc = location::all();
        return view('admin.setting.location', compact('loc'));
    }

    public function createLocation(Request $request)
    {
        $loc = new location;
        $loc->location_name = $request->location_name;
        $loc->save();
        return response()->json(['message' => 'Location Save Successfully'], 200);
    }
    public function updateLocation(Request $request)
    {
        $loc = location::find($request->id);
        $loc->location_name = $request->location_name;
        $loc->save();
        return response()->json(['message' => 'Location Update Successfully'], 200);
    }

    public function editLocation($id)
    {
        $loc = location::find($id);
        return response()->json($loc);
    }

    public function deleteLocation($id)
    {
        location::find($id)->delete();
        return response()->json(['message' => 'Location Delete Successfully'], 200);
    }
    public function showLocationManagement()
    {
        $lm = location_management::all();
        return view('admin.locationPriceManagement', compact('lm'));
    }
    public function createLocationManagement()
    {
        $loc = location::all();
        $product = product::whereIn('category', '!=', [1, 21])->get();
        return view('admin.locationPriceManagement', compact('loc', 'product'));
    }
}
