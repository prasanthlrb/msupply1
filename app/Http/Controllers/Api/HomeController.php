<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\category;
use App\brand;
use App\app_home_slider;
use App\product;
use AppHelper;
class HomeController extends Controller
{
    public function getCategory(){
        $cat = category::select('id','category_name','app_icon')->where('parent_id',0)->get();
        return response()->json($cat);
    }
    public function homeSlider(){
         $slider = app_home_slider::all();
         return response()->json($slider);
    }

    public function brandList(){
        $brand = brand::select('id','thumbnail','brand')->where('thumbnail','!=','')->where('thumbnail','!=',null)->get();
        return response()->json($brand);
    }
    public function todayProduct(){
        $product_today = product::where('featured', 'on')->orderBy('id', 'DESC')->take(10)->get();
                  if (count($product_today) > 0) {

                foreach ($product_today as $index => $row) {
                    if ($row->category != 1 && $row->category != 21) {
                        $lm = AppHelper::instance()->locationManagement($row->id);
                        if (isset($lm)) {
                            if ($lm->status == 0) {
                                if (isset($lm->sales_price)) {

                                    $row->sales_price = $lm->sales_price;
                                }
                                if (isset($lm->regular_price)) {

                                    $row->regular_price = $lm->regular_price;
                                }
                                if ($row->amount != null) {
                                    $row = AppHelper::instance()->productDiscount($row);
                                }
                            } else {
                                unset($product_today[$index]);
                                //$row = [];
                            }
                        } else {
                            if ($row->amount != null) {
                                $row = AppHelper::instance()->productDiscount($row);
                            }
                        }
                    } else {
                        if ($row->category == 1) {
                            $row = AppHelper::instance()->tilesSingleLocation($row->id);
                        }
                    }
                }
            }
             return response()->json($product_today);
    }
}
