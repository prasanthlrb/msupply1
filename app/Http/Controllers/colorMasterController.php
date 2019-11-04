<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\color;
use App\color_category;
use App\product;
use App\category;
use App\painting_guides;
use App\product_feature;
use App\paint_price;
use App\paint_lit;
use DB;

class colorMasterController extends Controller
{
    public function viewColors()
    {
        return view('admin.colors.colorMaster');
    }

    public function onloadShade()
    {
        $color = color::all();
        $shade_family = color_category::all();
        return response()->json(array($color, $shade_family));
    }

    public function deleteShadeFamily($id)
    {
        color_category::find($id)->delete();
        return response()->json(200);
    }

    public function deleteShadeColor($id)
    {
        color::find($id)->delete();
        return response()->json(200);
    }

    public function saveShadeFamily(Request $request)
    {
        $request->validate([
            'shade_family_name' => 'required',
            'shade_family_code' => 'required',
        ]);
        $data = [];
        if ($request->family_id) {
            $family = color_category::find($request->family_id);
            $family->shade_family_name = $request->shade_family_name;
            $family->shade_family_code = $request->shade_family_code;
            $family->save();
            $data = $family;
        } else {
            $family = new color_category;
            $family->shade_family_name = $request->shade_family_name;
            $family->shade_family_code = $request->shade_family_code;
            $family->save();
            $data = $family;
        }
        return response()->json($data);
    }

    public function saveShadeColor(Request $request)
    {
        $request->validate([
            'shade_name' => 'required',
            'shade_code' => 'required',
            'code_name' => 'required',
            'shade_family_id' => 'required'
        ]);
        if ($request->color_id) {
            $color = color::find($request->color_id);
            $color->shade_name = $request->shade_name;
            $color->shade_code = $request->shade_code;
            $color->code_name = $request->code_name;
            $color->shade_family_id = $request->shade_family_id;
            $color->save();
        } else {
            $color = new color;
            $color->shade_name = $request->shade_name;
            $color->shade_code = $request->shade_code;
            $color->code_name = $request->code_name;
            $color->shade_family_id = $request->shade_family_id;
            $color->save();
        }
        return response()->json($color);
    }



    public function colorBulkUpload()
    {
        $product = product::where('category', 21)->get();
        return view('admin.colors.bulkUpload', compact('product'));
    }

    public function bulkUploadColor(Request $request)
    {
        $colors = explode('*', $request->color_bank_bulk_data);
        $paint_lit = paint_lit::select('paint_lit')->where('product_id', $request->product_id)->get();

        try {
            // $bulkData = array();
            //         foreach($colors as $color){
            //            $checkColor = color::where('code_name',$color->code_name)->get();
            //            //if(empty($checkColor)){
            //             $bulkData[] =$color;
            //             $shade_family_id = color_category::where('shade_family_name',$color->shade_family)->get();
            //             $c = new color;
            //             $c->shade_name = $color->shade_name;
            //             $c->shade_code = $color->shade_code;
            //             $c->code_name = $color->code_name;
            //             $c->shade_family_id = $shade_family_id[0]->id;
            //             $c->save(); 
            //         //}
            //     }
            $x = 0;
            $colorMaster = array();
            $color = array(
                'code_name' => ''
            );
            foreach ($paint_lit as $lit) {
                $color[$lit->paint_lit] = '';
            }
            $subColor = $color;
            $limitLoop = count($color);
            foreach ($colors as $data) {
                // $x++;
                if ($x == 0) {
                    $color['code_name'] = trim($data);
                    $x++;
                } else if ($x < $limitLoop - 1) {
                    $color[$paint_lit[$x - 1]['paint_lit']] = trim($data);
                    $x++;
                } else {
                    $color[$paint_lit[$x - 1]['paint_lit']] = trim($data);
                    $colorMaster[] = $color;
                    $x = 0;
                }
            }

            $final = array();
            foreach ($colorMaster as $colors) {
                $color = color::where('code_name', $colors['code_name'])->first();
                if (isset($color)) {
                    //  if($colors[4] < $colors[10]){
                    foreach ($paint_lit as $liter) {
                        $paint = new paint_price;
                        $paint->colors_id = $color->id;
                        $paint->lit = $liter->paint_lit;
                        $paint->price = $colors[$liter->paint_lit];
                        $paint->product_id = $request->product_id;
                        $paint->save();
                        //$final[]=$paint;
                    }

                    // }else{
                    //      $paint = new paint_price;
                    //         $paint->colors_id = $color->id;
                    //         $paint->lit = 1;
                    //         $paint->price = $colors[1];
                    //         $paint->product_id = $request->product_id;
                    //         $paint->save();

                    //          $paint = new paint_price;
                    //         $paint->colors_id = $color->id;
                    //         $paint->lit = 4;
                    //         $paint->price = $colors[4];
                    //         $paint->product_id = $request->product_id;
                    //         $paint->save();

                    // }

                }
            }
        } catch (\Exception $e) {
            //return $e->getMessage();
            return response()->json($e->getMessage());
        }
        //return response()->json($colorMaster); 
        return response()->json(['message' => 'paint Price Update Successfully'], 200);
    }

    public function colorProduct()
    {
        $product = DB::table('products as p')
            ->select('p.id', 'p.product_name', 'c.category_name', 'p.product_image')
            ->where('category', 21)
            ->join('categories as c', 'p.sub_category', '=', 'c.id')
            ->get();
        //$product = product::where('category',21)->get();
        //return response()->json($product);
        return view('admin.colors.colorProduct', compact('product'));
    }

    public function newColorProduct(Request $request)
    {
        $category = category::where('parent_id', 21)->get();
        return view('admin.colors.newColorProduct', compact('category'));
    }

    public function colorProductSave(Request $request)
    {
        if ($request->product_id) {
            $product = product::find($request->product_id);
            $imageName = null;
            if ($request->file('product_image') != "") {
                $product_image = public_path() . '/product_img/' . $product->product_image;
                \File::delete($product_image);
                $image = $request->file('product_image');
                $imageName = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_img/'), $imageName);
                $product->product_image = $imageName;
            }
            $product->product_name = $request->product_name;
            $product->brand_name = 1;
            $product->sub_category = $request->sub_category;
            $product->tax_type = $request->tax_type;
            $product->tax = $request->tax;
            $product->product_description = $request->product_description;
            $product->save();

            $guide = painting_guides::where('product_id', $request->product_id)->first();
            $descImage = null;
            if ($request->file('description_image') != "") {
                $describImage = public_path() . '/description_image/' . $guide->description_image;
                \File::delete($describImage);
                $image = $request->file('description_image');
                $descImage = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('description_image/'), $descImage);
                $guide->description_image = $descImage;
            }
            $guide->finishers = $request->finishers;
            $guide->coverage = $request->coverage;
            $guide->drying = $request->drying_time;
            $guide->coating = $request->coats;
            $guide->save();

            foreach ($request->features as $index => $data) {
                $features = product_feature::where('product_id', $request->product_id)->get();
                if (count($features) > $index) {
                    $feature = product_feature::find($features[$index]->id);
                    $feature->features = $data;
                    $feature->save();
                } else {
                    $feature = new product_feature;
                    $feature->features = $data;
                    $feature->product_id = $product->id;
                    $feature->save();
                }
            }

            if (isset($request->amount) || isset($request->price)) {
                for ($i = 0; $i < count($request->amount); $i++) {
                    $isset_ava = 0;
                    $paintLit = new paint_lit;
                    if ($request->amount[$i] != null) {
                        $paintLit->amount = $request->amount[$i];
                        $isset_ava = 1;
                    }

                    if (isset($request->price_type[$i])) {
                        $paintLit->price_type = $request->price_type[$i];
                        $isset_ava = 1;
                    }
                    if (isset($request->paint_lit[$i])) {
                        $paintLit->paint_lit = $request->paint_lit[$i];
                        $isset_ava = 1;
                    }
                    if (isset($request->value_type[$i])) {
                        $paintLit->value_type = $request->value_type[$i];
                        $isset_ava = 1;
                    }
                    if (isset($request->price[$i])) {
                        $paintLit->price = $request->price[$i];
                        $isset_ava = 1;
                    }
                    if ($isset_ava == 1) {
                        //$totalDatas[]=$paintLit;
                        $paintLit->product_id = $product->id;
                        $paintLit->save();
                    }
                }
            }


            return response()->json('update');
        } else {
            $imageName = null;
            if ($request->file('product_image') != "") {
                $image = $request->file('product_image');
                $imageName = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_img/'), $imageName);
            }

            $product = new product;
            $product->product_name = $request->product_name;
            $product->category = 21;
            $product->brand_name = 1;
            $product->sub_category = $request->sub_category;
            $product->tax_type = $request->tax_type;
            $product->tax = $request->tax;
            $product->product_description = $request->product_description;
            $product->product_image = $imageName;
            $product->save();

            $descImage = null;
            if ($request->file('description_image') != "") {
                $image = $request->file('description_image');
                $descImage = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('description_image/'), $descImage);
            }

            $guide = new painting_guides;
            $guide->finishers = $request->finishers;
            $guide->coverage = $request->coverage;
            $guide->drying = $request->drying_time;
            $guide->coating = $request->coats;
            $guide->description_image = $descImage;
            $guide->product_id = $product->id;
            $guide->save();

            foreach ($request->features as $data) {
                $features = new product_feature;
                $features->features = $data;
                $features->product_id = $product->id;
                $features->save();
            }
        }
        if (isset($request->amount) || isset($request->price)) {
            for ($i = 0; $i < count($request->amount); $i++) {
                $isset_ava = 0;
                $paintLit = new paint_lit;
                if ($request->amount[$i] != null) {
                    $paintLit->amount = $request->amount[$i];
                    $isset_ava = 1;
                }

                if (isset($request->price_type[$i])) {
                    $paintLit->price_type = $request->price_type[$i];
                    $isset_ava = 1;
                }
                if (isset($request->paint_lit[$i])) {
                    $paintLit->paint_lit = $request->paint_lit[$i];
                    $isset_ava = 1;
                }
                if (isset($request->value_type[$i])) {
                    $paintLit->value_type = $request->value_type[$i];
                    $isset_ava = 1;
                }
                if (isset($request->price[$i])) {
                    $paintLit->price = $request->price[$i];
                    $isset_ava = 1;
                }
                if ($isset_ava == 1) {
                    //$totalDatas[]=$paintLit;
                    $paintLit->product_id = $product->id;
                    $paintLit->save();
                }
            }
        }
        return response()->json("save");
    }

    public function editColorProduct($id)
    {
        $product = product::find($id);
        $guide = painting_guides::where('product_id', $id)->first();
        $features = product_feature::where('product_id', $id)->get();
        $category = category::where('parent_id', 21)->get();
        $paintLit = paint_lit::where('product_id', $id)->get();
        return view('admin.colors.editProduct', compact('product', 'guide', 'features', 'category', 'paintLit'));
    }

    public function deleteProductFeature(Request $request)
    {
        product_feature::find($request->id)->delete();
        return response()->json(['message' => 'Color Feature Delete Successfully'], 200);
    }

    public function productPaintLit($id)
    {
        paint_lit::find($id)->delete();
        return response()->json(['message' => 'paint product Delete Successfully'], 200);
    }

    public function changePaintLit(Request $request)
    {
        $paint_lit = paint_lit::find($request->id);
        if ($request->fields == "price_type_edit") {
            $paint_lit->price_type = $request->data;
        } else if ($request->fields == "paint_lit_edit") {
            $paint_lit->paint_lit = $request->data;
        } else if ($request->fields == "value_type_edit") {
            $paint_lit->value_type = $request->data;
        } else if ($request->fields == "price_edit") { } else {
            $paint_lit->price = $request->data;
        }
        $paint_lit->save();
        return response()->json(['message' => 'paint product Update Successfully'], 200);
    }
}
