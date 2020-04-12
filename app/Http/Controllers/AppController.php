<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\app_login_slider;
use App\app_login_screen;
use App\app_home_slider;
use App\app_layout;
use App\app_layout_title;
use App\app_layout_item;
use App\app_recomended;
use File;
class AppController extends Controller
{
    public function LoginSlider(){
        $slider = app_login_slider::all();
        return view('app.loginSlider',compact('slider'));
    }

    public function LoginSliderEdit($id){
        $slider = app_login_slider::find($id);
        return response()->json($slider);
    }

    public function LoginSliderCreate(Request $request){
        if ($request->file('slider_image') != "" || $request->file('slider_image') != null) {
            $slider = new app_login_slider;
            $fileName = null;
            $image = $request->file('slider_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('login_slider/'), $fileName);
            $slider->slider_image = $fileName;
            $slider->save();
            return response()->json(['message'=>'Successfully Create'],200);
        }else{
            return response()->json(['message'=>'Please Select Correct File'],200);

        }
        
    }
    public function LoginSliderUpdate(Request $request){
        if ($request->file('slider_image') != "" || $request->file('slider_image') != null) {
            $slider = app_login_slider::find($request->id);
          $old_image = "login_slider/" . $slider->slider_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('slider_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('login_slider/'), $fileName);
            $slider->slider_image = $fileName;
            $slider->save();
        return response()->json($slider);
        return response()->json(['message'=>'Successfully Update'],200);
        }else{
            return response()->json(['message'=>'Please Select Correct File'],200);

        }
    }

    public function LoginSliderDelete($id){
        $slider = app_login_slider::find($id);
         $old_image = "login_slider/" . $slider->slider_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $slider->delete();
        return response()->json(['message'=>'Successfully Delete'],200);
    }
    //login slider end

    //login screen image
    public function LoginScreen(){
        $login_screen = app_login_screen::all();
        return view('app.loginScreen',compact('login_screen'));
    }
    public function LoginScreenUpdate(Request $request){
        
         $screen = app_login_screen::find($request->id);
        $fileName = null;
    if($request->file('firstInputImage')!=""){
    $image = $request->file('firstInputImage');
    $fileName = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('login_screen/'), $fileName);
    $screen->image = $fileName;
        }
        $screen->save();

         return response()->json($screen);
         return response()->json(['message'=>'Successfully Update'],200);
    }

    //end of login screen image


    //Home Slider
     public function HomeSlider(){
        $slider = app_home_slider::all();
        return view('app.homeSlider',compact('slider'));
    }

    public function HomeSliderEdit($id){
        $slider = app_home_slider::find($id);
        return response()->json($slider);
    }

    public function HomeSliderCreate(Request $request){
        if ($request->file('slider_image') != "" || $request->file('slider_image') != null) {
            $slider = new app_home_slider;
            $fileName = null;
            $image = $request->file('slider_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('home_slider/'), $fileName);
            $slider->slider_image = $fileName;
            $slider->save();
            return response()->json(['message'=>'Successfully Create'],200);
        }else{
            return response()->json(['message'=>'Please Select Correct File'],200);

        }
       
        
    }
    public function HomeSliderUpdate(Request $request){
        
          if ($request->file('slider_image') != "" || $request->file('slider_image') != null) {
            $slider = app_home_slider::find($request->id);
          $old_image = "home_slider/" . $slider->slider_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $fileName = null;
            $image = $request->file('slider_image');
            $fileName = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('home_slider/'), $fileName);
            $slider->slider_image = $fileName;
            $slider->save();
        return response()->json($slider);
        return response()->json(['message'=>'Successfully Update'],200);
        }else{
            return response()->json(['message'=>'Please Select Correct File'],200);

        }
        
    }

    public function HomeSliderDelete($id){
       $slider = app_home_slider::find($id);
         $old_image = "home_slider/" . $slider->slider_image;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $slider->delete();
        return response()->json(['message'=>'Successfully Delete'],200);
    }
    //end home slider

      //Start layout title
    public function LayoutTitle(){
        $title = app_layout_title::all();
        $layout = app_layout::all();
        $item = app_layout_item::all();
        return view('app.layout',compact('title','layout','item'));
    }
    public function LayoutTitleUpdate(Request $request){
         $screen = app_layout_title::find($id);
        $screen->image = $request->image;
        $screen->save();
         return response()->json(['message'=>'Successfully Update'],200);
    }

    //end of layout title



    
}
