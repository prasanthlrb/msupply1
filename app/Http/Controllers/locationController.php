<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\location;
use App\location_management;
use App\product;
use DB;

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
        //$lm = location_management::();
        $lm = DB::table('location_managements as lm')->select('lm.product_id', 'p.product_name')->groupBy('lm.product_id')
            ->join('products as p', 'p.id', '=', 'lm.product_id')->get();
        return view('admin.locationPriceManagement', compact('lm'));
        //return response()->json($lm);
    }
    public function createLocationManagement()
    {
        $loc = location::all();
        $product = product::where('category', '!=', 1)->where('category', '!=', 21)->get();
        return view('admin.createLocationPrice', compact('loc', 'product'));
    }
    public function assignPriceBasedLocation(Request $request)
    {
        $loc = location::all();
        foreach ($loc as $loc) {
            $lm = new location_management;
            $lm->location = $loc->location_name;
            $lm->product_id = $request->product;
            $lm->price = $request['price' . $loc->id];
            $lm->lat = $request['lat' . $loc->id];
            $lm->lng = $request['lng' . $loc->id];
            $lm->status = $request['status' . $loc->id];
            $lm->save();
        }

        return redirect('/admin/location-management_list');
    }

    public function editLocationManagement($id)
    {
        $lm = location_management::where('product_id', $id)->get();
        $product = product::find($id);
        return view('admin.editLocationPrice', compact('lm', 'product'));
    }
    public function editPriceBasedLocation(Request $request)
    {
        $lm = location_management::where('product_id', $request->product)->get();
        foreach ($lm as $loc) {
            $lm = location_management::find($loc->id);
            $lm->price = $request['price' . $loc->id];
            $lm->lat = $request['lat' . $loc->id];
            $lm->lng = $request['lng' . $loc->id];
            $lm->status = $request['status' . $loc->id];
            $lm->save();
        }
        return redirect('/admin/location-management_list');
    }

    public function DeleteLocationManagement($id)
    {
        location_management::where('product_id', $id)->delete();
        return response()->json(['message' => 'Successfully Delete'], 200);
    }
}
