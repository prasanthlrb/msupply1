<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\distance_price;

class calculatorController extends Controller
{
    public function steelCalc($id)
    {
        $product = product::where('brand_name', $id)->get();
        //return response()->json($product);
        return view('modal.steel', compact('product'));
    }

    public function bricksPredict(Request $request)
    {
        try {
            $data['status'] = 0;
            $distance = distance_price::where('product_id', $request->id)->get();
            foreach ($distance->sortBy('distance') as $disc) {
                if ($request->distance <= $disc->distance) {
                    $data['data'] = $disc;
                    $data['status'] = 1;
                    break;
                }
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
