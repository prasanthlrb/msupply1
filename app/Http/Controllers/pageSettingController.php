<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\adModel;
use App\homeSlider;
use App\home_product_layout;
use App\category;
use App\product;
use Auth;
use App\role;
class pageSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function homeAd(){

        $ads= adModel::all();
        return view('admin.setting.homeAd',compact('ads'));

    }
    public function adUpdate(Request $request){
        $ads = adModel::find($request->id);
        $fileName = null;
        if($request->id ==1){
    if($request->file('firstInputImage')!=""){
    $image = $request->file('firstInputImage');
    $fileName = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('ads/'), $fileName);
    $ads->ad_name = $fileName;
    }
        }else if($request->id == 2){
    if($request->file('firstInputImage')!=""){
    $image = $request->file('firstInputImage');
    $fileName = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('ads/'), $fileName);
    $ads->ad_name = $fileName;
    }
        }else{
    if($request->file('firstInputImage')!=""){
    $image = $request->file('firstInputImage');
    $fileName = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('ads/'), $fileName);
    $ads->ad_name = $fileName;
    }
        }
        $ads->url = $request->url;
        $ads->save();
        return response()->json($request);
    }

    public function showSlider(){
        $slider= homeSlider::orderBy('position', 'ASC')->get();
        $role = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.setting.slider',compact('slider','role'));
    }

    public function sliderSave(Request $request){
        $fileName = null;
       if($request->file('slider_image')!=""){
       $image = $request->file('slider_image');
       $fileName = rand() . '.' . $image->getClientOriginalExtension();
       $image->move(public_path('slider/'), $fileName);
       }
       $slider = new homeSlider;
       $slider->title = $request->title;
       $slider->sub_title = $request->sub_title;
       $slider->desc = $request->desc;
       $slider->button_text = $request->button_text;
       $slider->button_url = $request->button_url;
       $slider->button_color = $request->button_color;
       $slider->button_y = $request->button_y;
       $slider->slider_position = $request->slider_position;

       $slider->slider_image = $fileName;
       $slider->title_color = $request->title_color;
       $slider->title_y = $request->title_y;
       $slider->sub_color = $request->sub_color;
       $slider->sub_y = $request->sub_y;
       $slider->desc_color = $request->desc_color;
       $slider->desc_y = $request->desc_y;
       $position_count = count(homeSlider::all());
        if(empty($position_count)){
            $position_count = 0;
        }
        $slider->position = $position_count;
       $slider->save();
       return response()->json($slider);
    }
    public function sliderUpdate(Request $request){
        $slider = homeSlider::find($request->id);
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->desc = $request->desc;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;
        $slider->button_color = $request->button_color;
        $slider->button_y = $request->button_y;
        $slider->slider_position = $request->slider_position;
        $slider->title_color = $request->title_color;
        $slider->title_y = $request->title_y;
        $slider->sub_color = $request->sub_color;
        $slider->sub_y = $request->sub_y;
        $slider->desc_color = $request->desc_color;
        $slider->desc_y = $request->desc_y;
        $fileName = null;
       if($request->file('slider_image')!=""){
        $remove_file = public_path().'/slider/'. $slider->slider_image;
        if (file_exists($remove_file)) {
            unlink($remove_file);
        }
       $image = $request->file('slider_image');
       $fileName = rand() . '.' . $image->getClientOriginalExtension();
       $image->move(public_path('slider/'), $fileName);
       $slider->slider_image =  $fileName;
       }
        $slider->save();
        return response()->json($slider);

    }
    public function editSlider($id){
        $slider = homeSlider::find($id);
        return response()->json($slider);
    }
    public function deleteSlider($id){
        $slider = homeSlider::find($id);
        if($slider->slider_image !=null){
            $remove_file = public_path().'/slider/'. $slider->slider_image;
            if (file_exists($remove_file)) {
                unlink($remove_file);
            }
        }

        $sliderAll = homeSlider::all();
        if($slider->position != count($sliderAll)-1){
            $result = homeSlider::where('position','>',$slider->position)->orderBy('position', 'ASC')->get();
            $x= $slider->position;
            foreach($result as $row){
                $slider_Update = homeSlider::find($row->id);
                $slider_Update->position = $x;
                $slider_Update->save();
                $x++;
            }
        }
        $slider1 = homeSlider::find($id);
        $slider1->delete();
        return response()->json("200");
    }

    public function dropSlider($index,$id){
        $slider = homeSlider::find($id);
        $storeslider = array();
        if($slider->position > $index){
          for ($i= $index; $i < $slider->position; $i++) {
              $num = $i;
            $slider_drop = homeSlider::where('position',$i)->first();
            $slider_drop->position = $num+1;
            //$slider_drop->save();
            $storeslider[] = $slider_drop;
          }
          foreach($storeslider as $row){
            $slider_Update = homeSlider::find($row->id);
            $slider_Update->position = $row->position;
            $slider_Update->save();
          }

        }else{
            for ($i= $index; $i > $slider->position; $i--) {
                $num = $i;
              $slider_drop1 = homeSlider::where('position',$i)->first();
              $slider_drop1->position = $num-1;
             // $slider_drop->save();
             $storeslider[] = $slider_drop1;
            }
            foreach($storeslider as $row){
                $slider_Update = homeSlider::find($row->id);
                $slider_Update->position = $row->position;
                $slider_Update->save();
              }
        }
        $slider1 = homeSlider::find($id);
        $slider1->position = $index;
        $slider1->save();
        return response()->json($storeslider);

    }

    public function homeLayout(){
        $layout = home_product_layout::orderBy('position', 'ASC')->get();
        $product = product::all();
        $category = category::all();
        $role = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.setting.layout',compact('layout','product','category','role'));
    }
    public function SaveLayout(Request $request){
        $layout = new home_product_layout;
        $layout->title = $request->title;
        $layout->type = $request->type;
        if($request->type == "products"){
            $layout->product_id = collect($request->products)->implode(',');
        }else{
            $layout->category_id = collect($request->category)->implode(',');
        }
        $position_count = count(home_product_layout::all());
        if(empty($position_count)){
            $position_count = 0;
        }
        $layout->position = $position_count;
        $layout->save();
        return response()->json($request);
    }

    public function EditLayout($id){
        $layout =  home_product_layout::find($id);
        $product = product::all();
        $category = category::all();
        $output = '';
        if($layout->type == "products"){
            foreach(explode(',', $layout->product_id) as $row) {
                $layout_collection[] = $row;
            }
            $layout->product_id = $layout_collection;
            foreach($product as $prod){
                if(in_array($prod->id,$layout_collection)){
                    $output .= '<option value="'.$prod->id.'" selected>'.$prod->product_name.'</option>';
                }else{
                    $output .= '<option value="'.$prod->id.'">'.$prod->product_name.'</option>';
                }
            }
        }else{
            foreach(explode(',', $layout->category_id) as $row) {
                $layout_collection[] = $row;
            }
            $layout->category_id = $layout_collection;
            foreach($category as $cat){
                if(in_array($cat->id,$layout_collection)){
                    $output .= '<option value="'.$cat->id.'" selected>'.$cat->category_name.'</option>';
                }else{
                    $output .= '<option value="'.$cat->id.'">'.$cat->category_name.'</option>';
                }
            }
        }


        return response()->json(array($layout,$output));
    }
    public function UpdateLayout(Request $request){
        $layout =  home_product_layout::find($request->id);
        $layout->title = $request->title;
        $layout->type = $request->type;
        if($request->type == "products"){
            $layout->product_id = collect($request->products)->implode(',');
        }else{
            $layout->category_id = collect($request->category)->implode(',');
        }
        $layout->save();
        return response()->json($request);
    }

    public function DeleteLayout($id){
        $layout = home_product_layout::find($id);
        $layoutAll = home_product_layout::all();
        if($layout->position != count($layoutAll)-1){
            $result = home_product_layout::where('position','>',$layout->position)->orderBy('position', 'ASC')->get();
            $x= $layout->position;
            foreach($result as $row){
                $layout_Update = home_product_layout::find($row->id);
                $layout_Update->position = $x;
                $layout_Update->save();
                $x++;
            }
        }
        $layout1 = home_product_layout::find($id);
        $layout1->delete();
        return response()->json("200");
    }

    public function dropLayout($index,$id){
        $layout = home_product_layout::find($id);
        $storeLayout = array();
        if($layout->position > $index){
          for ($i= $index; $i < $layout->position; $i++) {
              $num = $i;
            $layout_drop = home_product_layout::where('position',$i)->first();
            $layout_drop->position = $num+1;
            //$layout_drop->save();
            $storeLayout[] = $layout_drop;
          }
          foreach($storeLayout as $row){
            $layout_Update = home_product_layout::find($row->id);
            $layout_Update->position = $row->position;
            $layout_Update->save();
          }

        }else{
            for ($i= $index; $i > $layout->position; $i--) {
                $num = $i;
              $layout_drop1 = home_product_layout::where('position',$i)->first();
              $layout_drop1->position = $num-1;
             // $layout_drop->save();
             $storeLayout[] = $layout_drop1;
            }
            foreach($storeLayout as $row){
                $layout_Update = home_product_layout::find($row->id);
                $layout_Update->position = $row->position;
                $layout_Update->save();
              }
        }
        $layout1 = home_product_layout::find($id);
        $layout1->position = $index;
        $layout1->save();
        return response()->json($storeLayout);

    }
}
