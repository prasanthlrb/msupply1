<?php

namespace App\Http\Controllers;
use App\deal;
use App\deal_attribute;
use App\product;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class dealController extends Controller
{
    public function index()
    {
        $deal = deal::all();
        return view('admin.view_deal', compact('deal'));
    }

    public function createDeal()
    {
        $product = product::all();
        $user = User::all();
        return view('admin.create_deal',compact('product','user'));
    }


    public function getUserID($id)
	{
		$data = User::find($id);
        return response()->json($data); 
    }
    
    public function getProductDeal($id)
	{
		$product = product::find($id);
        return response()->json($product); 
	}


}
