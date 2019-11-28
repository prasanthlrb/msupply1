<?php

namespace App\Http\Controllers;

use App\socialMedia;
use App\faq;
use App\contactInfo;
use App\home_setting;
use Illuminate\Http\Request;
use App\role;
use Auth;
use GuzzleHttp\Client;

class settingController extends Controller
{
    public function about()
    {
        $data = home_setting::all();
        return view('/admin/setting/about', compact('data'));
    }

    public function privacyPolicy()
    {
        $data = home_setting::all();
        return view('/admin/setting/privacy_police', compact('data'));
    }
    public function terms_condition()
    {
        $data = home_setting::all();
        return view('/admin/setting/terms_condition', compact('data'));
    }
    public function shipping_detail()
    {
        $data = home_setting::all();
        return view('/admin/setting/shipping_detail', compact('data'));
    }

    // update
    public function homeSettingabout(Request $request)
    {
        if (!empty($request->id)) {
            $data = home_setting::find($request->id);
        } else {
            $data = new home_setting;
        }
        $data->about_us = $request->about_us;
        $data->save();
        return redirect('/admin/about');
    }

    public function homeSettingshipping(Request $request)
    {
        if (!empty($request->id)) {
            $data = home_setting::find($request->id);
        } else {
            $data = new home_setting;
        }
        $data->shipping_details = $request->shipping_details;
        $data->save();
        return redirect('/admin/shipping_detail');
    }

    public function homeSettingterms(Request $request)
    {
        if (!empty($request->id)) {
            $data = home_setting::find($request->id);
        } else {
            $data = new home_setting;
        }
        $data->terms = $request->terms;
        $data->save();
        return redirect('/admin/terms_condition');
    }

    public function homeSettingPrivacyPolice(Request $request)
    {
        if (!empty($request->id)) {
            $data = home_setting::find($request->id);
        } else {
            $data = new home_setting;
        }
        $data->payment_terms = $request->payment_terms;
        $data->save();
        return redirect('/admin/privacy-policy');
    }

    public function contactView()
    {
        $data = contactInfo::all();
        if (count($data) >= 1) {
            // return view('admin.setting.contact',compact('data'));
            $data = $data[0];
            return view('admin.setting.contact', compact('data'));
        } else {
            $data = array(
                'id' => '0',
                'email' => '',
                'phone' => '',
                'address' => '',
                'described' => '',
                'map1' => '',
                'map2' => ''
            );
            //return response()->json($data['email']);
            return view('admin.setting.contact', compact('data'));
        }
        //
    }
    public function contactUpdate(Request $request)
    {
        if ($request->id == 0) {
            $data = new contactInfo;
        } else {

            $data = contactInfo::find($request->id);
        }
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->toll_free = $request->toll_free;
        $data->gstin = $request->gstin;
        $data->address = $request->address;
        $data->described = $request->described;
        $data->map1 = $request->map1;
        $data->map2 = $request->map2;
        $data->save();
        return redirect('/admin/contact-details');
    }
    public function faq()
    {
        $data = faq::all();
        $role = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.setting.faq', compact('data', 'role'));
    }
    public function faqStore(Request $request)
    {
        $faq = new faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return response()->json($faq);
    }
    public function faqUpdate(Request $request)
    {
        $faq = faq::find($request->id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return response()->json($faq);
    }
    public function editFaq($id)
    {
        $faq = faq::find($id);
        return response()->json($faq);
    }
    public function deleteFaq($id)
    {
        $faq = faq::find($id);
        $faq->delete();
        return response()->json($id);
    }
    public function socialMedia()
    {
        $data = socialMedia::all();
        if (count($data) >= 1) {
            $data = $data[0];
            return view('admin.setting.social', compact('data'));
        } else {
            $data = array(
                'id' => '0',
                'facebook' => '',
                'twitter' => '',
                'google' => '',
                'pinterest' => '',
                'flickr' => '',
                'youtube' => '',
                'vimeo' => '',
                'instagram' => '',
                'linkedin' => ''
            );
            return view('admin.setting.social', compact('data'));
        }
    }
    public function updatesocialMedia(Request $request)
    {
        if ($request->id == 0) {
            $data = new socialMedia;
        } else {

            $data = socialMedia::find($request->id);
        }
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->google = $request->google;
        $data->pinterest = $request->pinterest;
        $data->flickr = $request->flickr;
        $data->youtube = $request->youtube;
        $data->vimeo = $request->vimeo;
        $data->instagram = $request->instagram;
        $data->linkedin = $request->linkedin;
        $data->save();
        return redirect('/admin/social-details');
    }

    public function addRole()
    {
        $role = new role;
        $tb = $role->getTableColumns();
        unset($tb[0], $tb[1]);
        return view('admin.setting.addRole', compact('tb'));
    }

    public function createRole(Request $request)
    {
        //unset($request['_token']);
        $role = new role;
        $role->role_name = $request->role_name;
        foreach ($request->role as $row) {
            // $role[$row] = $row;
            $role[$row] = 1;
        }
        // role::create($request->all());
        $role->save();
        return redirect('/admin/role');
    }

    public function role()
    {
        $role = role::all();
        $roles = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.setting.role', compact('role', 'roles'));
    }

    public function editRole($id)
    {
        $role = new role;
        $tb = $role->getTableColumns();
        unset($tb[0], $tb[1]);
        $editRole = role::find($id);
        return view('admin.setting.editRole', compact('tb', 'editRole'));
    }

    public function updateRole(Request $request)
    {
        $role = new role;
        $tb = $role->getTableColumns();
        $editRole = role::find($request->role_id);
        $editRole->role_name = $request->role_name;
        unset($tb[0], $tb[1]);
        foreach ($tb as $row) {

            if (in_array($row, $request->role)) {
                $editRole[$row] = 1;
            } else {
                $editRole[$row] = null;
            }
        }
        $editRole->save();
        return redirect('/admin/role');
    }

    public function deleteRole($id)
    {
        role::find($id)->delete();
        return response()->json("200");
    }
    public function tilesUpload()
    {
        return view('admin.setting.tiles');
        // $client = new Client();
        // $res = $client->request('GET','http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Madurai');
        // //echo $res->getStatusCode();
        // // 200
        //  $res->getHeader('content-type');
        // // 'application/json; charset=utf8'
        // //echo $res->getBody();
        // echo $res->getBody()->getContents();
        // //dd($res);
    }
}
