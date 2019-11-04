<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\brand;
use App\upload;
use App\product;
use App\adModel;
use App\product_attribute;
use App\attribute;
use DB;
use App\review;
use App\rating;
use App\optionGroup;
use App\optionValue;
use App\custom_qty;
use App\painting_guides as painting_guide;
use App\product_feature;
use App\paint_price;
use App\product_unit;
use Session;
use App\location_management;

class categoryController extends Controller
{

    public function locationManagement($id)
    {
        $location = Session::get('locations');
        return $lm = location_management::where('location', $location)->where('product_id', $id)->first();
    }

    public function categoryProduct($id)
    {
        $category  = category::find($id);
        $adModel = adModel::all();
        $product = product::where('category', $id)->paginate(9);
        $brand = brand::all();
        $cat_type = 'category';
        if ($product->isEmpty()) {
            $product = product::where('sub_category', $id)->paginate(9);
            $cat_type = 'sub_category';
            if ($product->isEmpty()) {
                $product = product::where('second_sub_category', $id)->paginate(9);
                $cat_type = 'second_sub_category';
                if ($product->isEmpty()) {
                    $product = product::where('third_sub_category', $id)->paginate(9);
                    $cat_type = 'third_sub_category';
                }
            }
        }


        //    if($id == 21 || $id == 22 || $id == 23 || $id == 24 || $id == 25){
        //        if($id == 21){
        //         $product = product::where('category',$id)->paginate(9);
        //        }else{
        //         $product = product::where('sub_category',$id)->paginate(9);
        //        }

        if (count($product) > 0) {
            if ($product[0]->category == 1) {
                $product = $this->tilesLocationBasedData($cat_type, $id);
                return view('categoryTiles', compact('product', 'brand', 'adModel', 'category'));
            }
        }



        if (count($product) > 0) {
            if ($product[0]->category == 14) {
                $getBrandId = product::select('brand_name')->where($cat_type, $id)->groupBy('brand_name')->get();
                if (count($getBrandId) > 0) {
                    foreach ($getBrandId as $row) {
                        $brandId[] = $row->brand_name;
                    }
                    $brands = brand::whereIn('id', $brandId)->get();
                } else {
                    $brands = [];
                }
                return view('steelCategory', compact('brands', 'adModel', 'category', 'brand'));
            }
        }

        if (count($product) > 0) {

            if ($product[0]->group_product != null) {
                $getBrandId = product::select('brand_name')->where($cat_type, $id)->groupBy('brand_name')->get();
                if (count($getBrandId) > 0) {
                    foreach ($getBrandId as $row) {
                        $brandId[] = $row->brand_name;
                    }
                    $brands = brand::whereIn('id', $brandId)->get();
                } else {
                    $brands = [];
                }
                return view('groupCategory', compact('brands', 'brand', 'adModel', 'category'));
            }

            foreach ($product as $row) {
                $lm = $this->locationManagement($row->id);
                if (isset($lm) && $lm->status == 0) {
                    $row->sales_price = $lm->sales_price;
                    $row->regular_price = $lm->regular_price;
                }
                if ($row->amount != null) {
                    if ($row->price_type == "discount") {
                        if ($row->value_type == "percentage") {
                            $row->sales_price = $row->sales_price - ($row->sales_price * ($row->amount / 100));
                        } else {
                            $row->sales_price = $row->sales_price - $row->amount;;
                        }
                    } else {
                        if ($row->value_type == "percentage") {
                            $row->sales_price = $row->sales_price + ($row->sales_price * ($row->amount / 100));
                        } else {
                            $row->sales_price = $row->sales_price + $row->amount;
                        }
                    }
                }
            }
        }



        return view('category', compact('product', 'brand', 'adModel', 'category'));
    }



    public function categorySortProduct($id, $sort)
    {
        $category  = category::find($id);
        $adModel = adModel::all();
        if ($sort == 1) {
            $orderType = 'ASC';
        } else {
            $orderType = 'DESC';
        }
        $brand = brand::all();
        // return response()->json($product);
        if ($id == 21 || $id == 22 || $id == 23 || $id == 24 || $id == 25) {
            if ($id == 21) {
                $product = product::where('category', $id)->paginate(9);
            } else {
                $product = product::where('sub_category', $id)->paginate(9);
            }
        } else if ($id == 1 || $id == 2 || $id == 3) {
            $product = $this->tilesLocationBasedSort($id, $orderType);
            // return response()->json($product);
            return view('categoryTiles', compact('product', 'brand', 'adModel', 'category'));
        } else if ($id == 14) {
            $getBrandId = product::select('brand_name')->where('category', $id)->groupBy('brand_name')->get();
            if (count($getBrandId) > 0) {
                foreach ($getBrandId as $row) {
                    $brandId[] = $row->brand_name;
                }
                $brands = brand::whereIn('id', $brandId)->get();
            } else {
                $brands = [];
            }
            return view('steelCategory', compact('brands', 'adModel', 'category', 'brand'));
        } else {
            $product = product::where('category', $id)->paginate(9);
        }
        return view('category', compact('product', 'brand', 'adModel', 'category'));
    }

    public function getProduct($id)
    {
        $product1 = product::find($id);
        $Upload = upload::where('product_id', '=', $id)->get();
        //if (isset($product1)) {
        $lm = $this->locationManagement($id);
        //return response()->json($lm);
        if (isset($lm) && $lm->status == 0) {
            $product1->sales_price = $lm->sales_price;
            $product1->regular_price = $lm->regular_price;
        }
        if ($product1->amount != null) {
            if ($product1->price_type == "discount") {
                if ($product1->value_type == "percentage") {
                    $product1->sales_price = $product1->sales_price - ($product1->sales_price * ($product1->amount / 100));
                } else {
                    $product1->sales_price = $product1->sales_price - $product1->amount;;
                }
            } else {
                if ($product1->value_type == "percentage") {
                    $product1->sales_price = $product1->sales_price + ($product1->sales_price * ($product1->amount / 100));
                } else {
                    $product1->sales_price = $product1->sales_price + $product1->amount;
                }
            }
        }
        //}
        if ($product1->category == 21) {
            $subCategoty = category::find($product1->sub_category);
            $guide = painting_guide::where('product_id', $product1->id)->first();
            $feature = product_feature::where('product_id', $product1->id)->get();
            //$paint_price = paint_price::where('product_id',$product1->id)->groupBy('lit')->get();
            $liter = DB::table('paint_prices')->select('lit', DB::raw('count(*) as total'))->where('product_id', $id)->groupBy('lit')->get();
            $relatedProducts = product::where('sub_category', $product1->sub_category)->where('id', '!=', $product1->id)->get();
            //return response()->json($relatedProducts);
            $brand = brand::find($product1->brand_name);
            return view('paint_product', compact('product1', 'subCategoty', 'guide', 'feature', 'liter', 'relatedProducts', 'brand'));
        } else if ($product1->category == 1) {

            $stock = $this->tilesSingleLocation($product1->id);
            $subCategoty = category::find($product1->sub_category);
            $second_sub_category = category::find($product1->second_sub_category);
            $third_sub_category = category::find($product1->third_sub_category);
            if ($product1->related_product == null) {
                $divider = explode(' ', $product1->product_name, 2);
                if (count($divider) > 1) {
                    $relatedProducts = product::where('third_sub_category', $product1->third_sub_category)
                        ->where('id', '!=', $product1->id)
                        ->where('product_name', 'like', substr($product1->product_name, 0, strlen($divider[0])) . '%')
                        ->where('stock_quantity', '>', 200)
                        ->take(20)->get();
                    if (count($relatedProducts) == 0) {
                        $relatedProducts = product::where('third_sub_category', $product1->third_sub_category)
                            ->where('id', '!=', $product1->id)
                            ->where('stock_quantity', '>', 200)
                            ->take(20)->get();
                    }
                } else {
                    $relatedProducts = product::where('second_sub_category', $product1->second_sub_category)
                        ->where('id', '!=', $product1->id)
                        ->where('stock_quantity', '>', 200)
                        ->take(20)->get();
                }
            } else {
                $related = explode(',', $product1->related_product);
                $relatedProducts = product::whereIn('id', $related)->get();
            }
            //return response()->json($stock);
            //return response()->json($relatedProducts);
            $brand = brand::find($product1->brand_name);
            return view('tilesProduct', compact('product1', 'subCategoty', 'relatedProducts', 'stock', 'Upload', 'second_sub_category', 'third_sub_category', 'brand'));
        } else if ($product1->map_location == 'on') {
            // return response()->json($Upload);
            $custom_qty = custom_qty::where('product_id', $product1->id)->get();
            return view('bricksProduct', compact('product1', 'custom_qty', 'Upload'));
        } else {

            $brand = brand::all();
            $reviews = review::where('item_id', $id)->get();
            $review = DB::table('reviews as r')
                ->where('r.item_id', $id)
                ->where('r.status', 1)
                ->join('ratings as ra', 'r.order_item_id', '=', 'ra.order_item_id')
                ->join('users as u', 'r.user_id', '=', 'u.id')
                ->select('r.review', 'r.updated_at', 'u.name', 'ra.rating')
                ->paginate(6);

            $rating = rating::where('item_id', $id)->get();
            $related_product = [];
            if ($product1->related_product) {
                $related_product = product::whereIn('id', explode(',', $product1->related_product))->get();
            }
            $category_id = explode(',', $product1->category);
            $breadcrumbs = category::find($category_id[0]);
            $product_attribute = product_attribute::where('group_id', '=', $product1->group)->get();
            $attribute = attribute::all();
            //return response()->json($review);

            $optionGroup = optionGroup::where('product_id', $id)->get();
            $optionData['group'] = $optionGroup;
            if (count($optionGroup) > 0) {
                foreach ($optionGroup as $group) {
                    $optionData[$group->id] = optionvalue::where('group_id', $group->id)->get();
                }
            }

            $custom_qty = custom_qty::where('product_id', $id)->get();
            //return response()->json($optionData[1][2]['name']);
            //dd($optionData);
            $brand = brand::find($product1->brand_name);
            return view('product', compact('product1', 'optionData', 'brand', 'Upload', 'related_product', 'breadcrumbs', 'product_attribute', 'attribute', 'review', 'reviews', 'rating', 'custom_qty'));
        }
    }

    public function steelProduct($id)
    {
        $brands = brand::find($id);

        $product = product::where('brand_name', $id)->get();
        $category = category::find($product[0]->category);
        foreach ($product as $pro) {
            $product_id[] = $pro->id;
            if ($pro->amount != null) {
                $change_price = product_unit::where('product_id', $pro->id)->get();
                foreach ($change_price as $row) {
                    if ($pro->price_type == "discount") {
                        if ($pro->value_type == "percentage") {
                            $row->unit_price = $row->unit_price - ($row->unit_price * ($pro->amount / 100));
                        } else {
                            $row->unit_price = $row->unit_price - $row->amount;;
                        }
                    } else {
                        if ($pro->value_type == "percentage") {
                            $row->unit_price = $row->unit_price + ($row->unit_price * ($pro->amount / 100));
                        } else {
                            $row->unit_price = $row->unit_price + $row->amount;
                        }
                    }
                }
                $unit[] = $change_price;
            } else {

                $unit[] = product_unit::where('product_id', $pro->id)->get();
            }
        }
        $unit_title = product_unit::select('unit_name')->whereIn('product_id', $product_id)->groupBy('unit_name')->get();
        //return response()->json($unit);

        return view('steelProduct', compact('product', 'brands', 'unit', 'unit_title', 'category'));
    }

    public function advanceFilter($product_id, $attr, $terms)
    {
        $product_attribute = product_attribute::where('product_id', '=', $product_id)->get();
        $terms_data = product_attribute::where('terms_id', '=', $terms)->where('group_id', $product_attribute[0]->group_id)->get();
        $terms_val = array();
        $checkAttr = null;
        $product_id_final = array();
        foreach ($product_attribute as $attribute_val) {

            if ($attr == $attribute_val->attribute) {
                $terms_val[] = $terms;
                $checkAttr = $terms;
            } else {
                $terms_val[] = $attribute_val->terms_id;
            }
        }
        if ($checkAttr == null) {
            $terms_val[] = $terms;
        }
        $finalResult = product_attribute::whereIn('terms_id', $terms_val)->where('group_id', $product_attribute[0]->group_id)->get();
        foreach ($finalResult as $result) {
            $product_id_final[] = $result->product_id;
        }
        $values = array_count_values($product_id_final);
        arsort($values);
        $popular = array_slice(array_keys($values), 0, 5, true);
        if ($product_id == $popular[0]) {
            $redirectPage = $popular[1];
        } else {
            $redirectPage = $popular[0];
        }
        //return response()->json($popular);
        return redirect('product/' . $redirectPage);
        //return $this->getProduct($redirectPage);
    }

    public function filterBrand($id)
    {
        $brandid = brand::find($id);
        $adModel = adModel::all();
        $product = product::where('brand_name', $id)->paginate(9);
        $brand = brand::all();
        // return response()->json($product);
        return view('brandView', compact('product', 'brand', 'adModel', 'brandid'));
    }
    public function tilesLocationBasedData($where, $id)
    {
        $location = Session::get('locations');
        //$location = 'Salem';
        $data = $this->locationValues();
        if ($id == 1) {
            $stock = DB::table('tiles_stock_locations as tsl')
                ->select(DB::raw('sum(tsl.stock) as stocks,max(tsl.price) as sales_price, tsl.product_id,p.product_name,p.product_image,p.sub_category,p.product_description,p.category,p.amount,p.price_type,p.value_type'))
                ->whereIn('tsl.location', $data[$location])
                ->where('stock', '>', 25)
                ->join('products as p', 'p.id', '=', 'tsl.product_id')
                ->groupBy('tsl.product_id')
                ->orderBy('stocks', 'desc')
                ->paginate(9);
        } else {
            $stock = DB::table('tiles_stock_locations as tsl')
                ->select(DB::raw('sum(tsl.stock) as stocks,max(tsl.price) as sales_price, tsl.product_id,p.product_name,p.product_image,p.sub_category,p.product_description,p.category,p.amount,p.price_type,p.value_type'))
                ->whereIn('tsl.location', $data[$location])
                ->where('stock', '>', 25)
                ->where($where, $id)
                ->join('products as p', 'p.id', '=', 'tsl.product_id')
                ->groupBy('tsl.product_id')
                ->orderBy('stocks', 'desc')
                ->paginate(9);
        }
        if (count($stock) > 0) {
            foreach ($stock as $row) {
                if ($row->amount != null) {
                    if ($row->price_type == "discount") {
                        if ($row->value_type == "percentage") {
                            $row->sales_price = $row->sales_price - ($row->sales_price * ($row->amount / 100));
                        } else {
                            $row->sales_price = $row->sales_price - $row->amount;;
                        }
                    } else {
                        if ($row->value_type == "percentage") {
                            $row->sales_price = $row->sales_price + ($row->sales_price * ($row->amount / 100));
                        } else {
                            $row->sales_price = $row->sales_price + $row->amount;
                        }
                    }
                }
            }
        }
        //$stock = tiles_stock_location::whereIn('location',$data[$location])->get();

        return $stock;
    }

    public function tilesLocationBasedSort($id, $sort)
    {
        $location = Session::get('locations');
        //$location = 'Salem';
        $data = $this->locationValues();
        if ($id == 1) {
            $stock = DB::table('tiles_stock_locations as tsl')
                ->select(DB::raw('sum(tsl.stock) as stocks , max(tsl.price) as sales_price, tsl.product_id,p.product_name,p.product_image,p.sub_category,p.product_description,p.category,p.amount,p.price_type,p.value_type'))
                ->whereIn('tsl.location', $data[$location])
                ->where('stock', '>', 25)
                ->join('products as p', 'p.id', '=', 'tsl.product_id')
                ->groupBy('tsl.product_id')
                ->orderBy('sales_price', $sort)
                ->paginate(9);
        } else {
            $stock = DB::table('tiles_stock_locations as tsl')
                ->select(DB::raw('sum(tsl.stock) as stocks,max(tsl.price) as sales_price, tsl.product_id,p.product_name,p.product_image,p.sub_category,p.product_description,p.category,p.amount,p.price_type,p.value_type'))
                ->whereIn('tsl.location', $data[$location])
                ->where('p.sub_category', $id)
                ->where('stock', '>', 25)
                ->join('products as p', 'p.id', '=', 'tsl.product_id')
                ->groupBy('tsl.product_id')
                ->orderBy('sales_price', $sort)
                ->paginate(9);
        }
        if (count($stock) > 0) {
            foreach ($stock as $row) {
                if ($row->amount != null) {
                    if ($row->price_type == "discount") {
                        if ($row->value_type == "percentage") {
                            $row->sales_price = $row->sales_price - ($row->sales_price * ($row->amount / 100));
                        } else {
                            $row->sales_price = $row->sales_price - $row->amount;;
                        }
                    } else {
                        if ($row->value_type == "percentage") {
                            $row->sales_price = $row->sales_price + ($row->sales_price * ($row->amount / 100));
                        } else {
                            $row->sales_price = $row->sales_price + $row->amount;
                        }
                    }
                }
            }
        }
        //$stock = tiles_stock_location::whereIn('location',$data[$location])->get();

        return $stock;
    }

    public function tilesSingleLocation($id)
    {
        $location = Session::get('locations');
        $data = $this->locationValues();

        $stock = DB::table('tiles_stock_locations as tsl')
            ->select(DB::raw('sum(tsl.stock) as stocks,max(tsl.price) as sales_price, tsl.product_id,p.product_name,p.product_image,p.sub_category,p.amount,p.price_type,p.value_type,p.group_product,p.category,p.id,p.regular_price,p.width,p.weight,p.length,p.items,p.product_description,p.map_location'))
            ->whereIn('tsl.location', $data[$location])
            ->where('p.id', $id)
            ->join('products as p', 'p.id', '=', 'tsl.product_id')
            ->groupBy('tsl.product_id')
            ->orderBy('stocks', 'desc')
            ->first();
        if ($stock->amount != null) {
            if ($stock->price_type == "discount") {
                if ($stock->value_type == "percentage") {
                    $stock->sales_price = $stock->sales_price - ($stock->sales_price * ($stock->amount / 100));
                } else {
                    $stock->sales_price = $stock->sales_price - $stock->amount;;
                }
            } else {
                if ($stock->value_type == "percentage") {
                    $stock->sales_price = $stock->sales_price + ($stock->sales_price * ($stock->amount / 100));
                } else {
                    $stock->sales_price = $stock->sales_price + $stock->amount;
                }
            }
        }
        return $stock;
    }

    public function locationValues()
    {
        return  $data = array(
            'Ariyalur' => ['Trichy', 'Karaikal'],
            'Chennai' => ['Perungalthur', 'Pallavaram', 'Vadapalani', 'Tambaram'],
            'Coimbatore' => ['Coimbatore'],
            'Cuddalore' => ['Pondicherry'],
            'Dindigul' => ['Madurai', 'Trichy'],
            'Dharmapuri' => ['Salem', 'Vellore'],
            'Erode' => ['Coimbatore', 'Salem'],
            'Karur' => ['Trichy'],
            'Kanniyakumari' => ['Tirunelveli'],
            'Kanchipuram' => ['Perungalthur', 'Pallavaram', 'Vadapalani', 'Tambaram'],
            'Krishnagiri' => ['Vellore'],
            'Madurai' => ['Madurai', 'Trichy'],
            'Nillgiris' => ['Coimbatore'],
            'Namakkal' => ['Salem', 'Trichy'],
            'Nagapattinam' => ['Karaikal'],
            'Perambalur' => ['Salem', 'Trichy'],
            'Pudukottai' => ['Trichy'],
            'Ramanathapuram' => ['Madurai', 'Tirunelveli'],
            'Salem' => ['Salem'],
            'Sivaganga' => ['Madurai', 'Trichy'],
            'Thanjavur' => ['Trichy'],
            'Theni' => ['Madurai'],
            'Thoothukudi' => ['Tirunelveli'],
            'Tiruppur' => ['Coimbatore'],
            'Tirunelveli' => ['Tirunelveli'],
            'Tiruchirappalli' => ['Trichy', 'Madurai'],
            'Tiruvannamalai' => ['Vellore', 'Pondicherry'],
            'Tiruvallur' => ['Perungalthur', 'Pallavaram', 'Vadapalani', 'Tambaram'],
            'Tiruvarur' => ['Karaikal'],
            'Virudunagar' => ['Madurai', 'Tirunelveli'],
            'Vellore' => ['Vellore'],
            'Viluppuram' => ['Pondicherry'],
        );
    }
}
