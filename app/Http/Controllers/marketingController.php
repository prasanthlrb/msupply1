<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\marketing;

class marketingController extends Controller
{
    public function index()
    {
        $lists = marketing::all();
        return view('admin.marketing', compact('lists'));
    }

    public function saveSend(Request $request)
    {
        $marketing = new marketing;
        $marketing->title = $request->title;
        $marketing->image = $request->image;
        $marketing->content = $request->content;
        $marketing->sms = $request->sms;
        $marketing->email = $request->email;
        $marketing->facebook = $request->facebook;
        $marketing->whatapp = $request->whatapp;
        $marketing->send_type = $request->send_type;
        $marketing->contact_id = $request->contact_id;
        $marketing->status = $request->status;
        $marketing->save();
        if ($request->if_send == 1) { }
    }

    public function updateData(Request $request)
    {
        $marketing = marketing::find($request->id);
        $marketing->title = $request->title;
        $marketing->image = $request->image;
        $marketing->content = $request->content;
        $marketing->sms = $request->sms;
        $marketing->email = $request->email;
        $marketing->facebook = $request->facebook;
        $marketing->whatapp = $request->whatapp;
        $marketing->send_type = $request->send_type;
        $marketing->contact_id = $request->contact_id;
        $marketing->status = $request->status;
        $marketing->save();
        if ($request->if_send == 1) { }
    }

    public function editData($id)
    {
        $list = marketing::find($id);
        return response()->json($list);
    }

    public function deleteData($id)
    {
        marketing::find($id)->delete();
        return response()->json(['message' => 'Successfully Delete'], 200);
    }
}
