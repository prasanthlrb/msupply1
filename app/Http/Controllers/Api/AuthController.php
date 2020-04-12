<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\app_login_slider;
use App\app_login_screen;
use App\location_management;
use AppHelper;
class AuthController extends Controller
{
    public function SliderLogin(){
            $slider = app_login_slider::all();
        return response()->json($slider);
    }

    public function loginImage(){
        $login = app_login_screen::select('image')->find(1);
        return response()->json($login);
    }
    public function signupImage(){
        $signup = app_login_screen::select('image')->find(2);
        return response()->json($signup);
    }

    public function getLocation(){
        $location = AppHelper::instance()->location();
        return response()->json($location);
    }
}
