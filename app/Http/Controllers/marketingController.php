<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\marketing;
use AppHelper;
use App\Mail\PostMailable;
use Illuminate\Support\Facades\Mail;
use Notification;
use App\Notifications\NewsWasPublished;
class marketingController extends Controller
{
    public function index()
    {
        $lists = marketing::all();
        return view('admin.marketing.postList', compact('lists'));
    }
    public function createNew()
    {
        $users = User::all();
        return view('admin.marketing.createNew', compact('users'));
    }

    public function saveSend(Request $request)
    {
        $sms = 0;
        $email = 0;
        $facebook = 0;
        $whatsapp = 0;
        $msg = '';
        $marketing = new marketing;
        $marketing->title = $request->title;
        $fileName = null;
        if ($request->file('image') != "" || $request->file('image') != null) {
            $image = $request->file('image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post_image/'), $fileName);
            $marketing->image = $fileName;
        }
        $marketing->content = $request->content;
        if (isset($request->sms)) {
            $marketing->sms = $request->sms;
            $sms = 1;
        }
        if (isset($request->email)) {
            $marketing->email = $request->email;
            $email = 1;
        }
        if (isset($request->facebook)) {
            $marketing->facebook = $request->facebook;
            $facebook = 1;
        }
        if (isset($request->whatapp)) {
            $marketing->whatapp = $request->whatapp;
            $whatsapp = 1;
        }
        $marketing->send_type = $request->send_type;
        if ($request->send_type == 1) {
            $marketing->contact_id = collect($request->contact_id)->implode(',');
        }
        
        if ($request->save_type == 1) {
            $marketing->status = 1;
            $marketing->save();
            $msg = 'Post Save & Send Successfully';
            if ($request->send_type == 0) {
                $contact = User::all();
            } else {
                $contact = User::whereIn('id', $request->contact_id)->get();
            }
            if ($sms == 1) {
                $content = $request->title.','.$request->content;
                //$this->sms($contact, $content);
            }
            if ($email == 1) {
               // $this->email($contact, $marketing);
            }
            if ($facebook == 1) { }
            if ($whatsapp == 1) { }
        } else {
            $msg = 'Post Save Successfully';
            $marketing->status = 0;
            $marketing->save();
        }
        
        return response()->json($request);
    }

    public function sms($contact, $message)
    {
        foreach ($contact as $user) {

            AppHelper::instance()->sendMessage($message, $user->phone);
        }
    }
    public function email($contact, $request)
    {
        foreach ($contact as $user) {
            Mail::to($user->email)->send(new PostMailable($request));
        }
    }

    public function updateData(Request $request)
    {
          $sms = 0;
        $email = 0;
        $facebook = 0;
        $whatsapp = 0;
        $msg = '';
        $marketing = marketing::find($request->id);
        $marketing->title = $request->title;
        $fileName = null;
        if ($request->file('image') != "" || $request->file('image') != null) {
            $image = $request->file('image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post_image/'), $fileName);
            $marketing->image = $fileName;
        }
        $marketing->content = $request->content;
        if (isset($request->sms)) {
            $marketing->sms = $request->sms;
            $sms = 1;
        }
        if (isset($request->email)) {
            $marketing->email = $request->email;
            $email = 1;
        }
        if (isset($request->facebook)) {
            $marketing->facebook = $request->facebook;
            $facebook = 1;
        }
        if (isset($request->whatapp)) {
            $marketing->whatapp = $request->whatapp;
            $whatsapp = 1;
        }
        $marketing->send_type = $request->send_type;
        if ($request->send_type == 1) {
            $marketing->contact_id = collect($request->contact_id)->implode(',');
        }
        
        if ($request->save_type == 1) {
            $marketing->status = 1;
            $marketing->save();
            $msg = 'Post Save & Send Successfully';
            if ($request->send_type == 0) {
                $contact = User::all();
            } else {
                $contact = User::whereIn('id', $request->contact_id)->get();
            }
            if ($sms == 1) {
                $content = $request->title.','.$request->content;
                $this->sms($contact, $content);
            }
            if ($email == 1) {
                $this->email($contact, $marketing);
            }
            if ($facebook == 1) { }
            if ($whatsapp == 1) { }
        } else {
            $msg = 'Post Save Successfully';
            $marketing->status = 0;
            $marketing->save();
        }
        
        return response()->json(['message' => $msg], 200);
    }

    public function editData($id)
    {
        $list = marketing::find($id);
        $users = User::all();
        $checked = array();
        if ($list->send_type == 1) {
            foreach (explode(',', $list->contact_id) as $id) {
                $checked[] = $id;
            }
        }
        return view('admin.marketing.updatePost', compact('users', 'list', 'checked'));
    }

    public function deleteData($id)
    {
        marketing::find($id)->delete();
        return response()->json(['message' => 'Successfully Delete'], 200);
    }

    public function publishedPost(){
        $data ="text";
        Notification::send($data,new NewsWasPublished($data));
    }
}
