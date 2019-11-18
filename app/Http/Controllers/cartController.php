<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\color;
use App\color_category;
use App\product;
use App\brand;
use App\optionGroup;
use App\optionValue;
use Cart;
use Illuminate\Support\Collection;
use AppHelper;

class cartController extends Controller
{
    public function postCartItem(Request $request)
    {
        $product = product::find($request->product_id);
        //     $price = $product->sales_price;
        //     $additionalPrice =0;
        //     $optionData = $request;


        //     $option_group = optionGroup::where('product_id',$request->product_id)->get();
        //     $optionName =$request->product_id;
        //     // $option = '';
        //     if(count($option_group) > 0){
        //     foreach($option_group as $group){
        //         $optionVal = optionValue::where('group_id',$group->id)->where('name',$request[$group->id])->first();
        //         $optionName = $optionName.'_'.$group->id.'_'.$optionVal->id;
        //         if($optionVal->home_option != 1){
        //             if($price < $optionVal->current_price){
        //                 $price = $optionVal->current_price;
        //             }
        //             if($optionVal->additional_price !=null){
        //                 $additionalPrice +=$optionVal->additional_price;
        //             }
        //         }

        //         $getOptionData[] = $optionVal;
        //     }
        //     $getOption['option'] = $getOptionData;
        // }


        // $cart_qty = Cart::get($optionName);
        // $totalQty = $cart_qty['quantity'] + $request->qty;
        // $total_price = ($price+$additionalPrice) * $totalQty;

        //if($product->stock_quantity >= $totalQty){
        if ($product->amount != null) {
            if ($product->price_type == "discount") {
                if ($product->value_type == "percentage") {
                    $product->sales_price = $product->sales_price - ($product->sales_price * ($product->amount / 100));
                } else {
                    $product->sales_price = $product->sales_price - $product->amount;;
                }
            } else {
                if ($product->value_type == "percentage") {
                    $product->sales_price = $product->sales_price + ($product->sales_price * ($product->amount / 100));
                } else {
                    $product->sales_price = $product->sales_price + $product->amount;
                }
            }
        }
        $cat = category::find($product->category);
        $attribute = array(
            'product_type' => $cat->category_name,
            'brand' => $product->brand_name,
            'category' => $product->category
        );
        Cart::add(array(
            'id' => $product->id,
            'name' => $product->product_name,
            'price' => $product->sales_price,
            'quantity' => $request->qty,
            'attributes' => $attribute,
        ));
        // $status =0;
        // }else{
        //     $status =1;
        // }

        $total = Cart::getTotal();
        $quantity = count(Cart::getContent());
        //return response()->json(array($status,$total,$quantity));
        return response()->json(Cart::getContent());
    }



    public function getCartItem(Request $request)
    {
        return response()->json($request);
    }

    public function paintProductAddtoCart(Request $request)
    {
        if ($request->lit != 0 && $request->colors_code != "undefined") {
            $optionName = $request->product_id . '0' . $request->lit . '0' . $request->colors_id;
        } else {
            if ($request->lit != 0) {
                $optionName = $request->product_id . '0' . $request->lit;
            } else {
                $optionName = $request->product_id;
            }
        }
        //   $cart_qty = Cart::get($optionName);
        // $totalQty = $cart_qty['quantity'] + $request->button_qty;
        // $total_price = $request->paint_price * $totalQty;
        $attribute = array(
            'color' => true,
            'product_id' => $request->product_id,
            'lit' => $request->lit,
            'color_id' => $request->colors_id,
            'color_code' => $request->colors_code,
            'brand' => "1",
            'category' => "21"
        );
        Cart::add(array(
            'id' => $optionName,
            'name' => $request->product_name,
            'price' => $request->paint_price,
            'quantity' => $request->button_qty,
            'attributes' => $attribute,
        ));
        return response()->json(Cart::getContent());
    }

    public function cartData()
    {

        $cartCollection = Cart::getContent();
        //get brand
        //return response()->json($cartCollection);
        $brand_data = array();
        foreach ($cartCollection as $b) {
            $brand_data[$b['attributes']->brand] = $b['attributes']->brand; // Get unique country by code.
            //array_push($brand_data[$b['attributes']->brand], );
        }
        $get_brand = brand::whereIn('id', $brand_data)->get();
        foreach ($get_brand as $b) {
            $dummy_total = array('total' => 0, 'brand' => '', 'order_type' => '', 'category' => '');
            foreach ($cartCollection as $c) {
                if ($b->id == $c['attributes']->brand) {
                    if ($b->order_type == 0) {
                        $dummy_total['total'] += $c['quantity'];
                        $dummy_total['brand'] = $c['attributes']->brand;
                        $dummy_total['category'] = $c['attributes']->category;
                        $dummy_total['order_type'] = "QTY";
                    } elseif ($b->order_type == 1) {
                        if ($c['attributes']->category == 14) {
                            $prod = product::find($c['id']);
                            if ($c['attributes']->unit_name == "Rods") {
                                $dummy_total['total'] += ceil($c['quantity'] * $prod->weight);
                                $dummy_total['brand'] = $c['attributes']->brand;
                                $dummy_total['category'] = $c['attributes']->category;
                                $dummy_total['order_type'] = "Kg Weight";
                            } else {
                                $weight = ($prod->weight * $prod->items);
                                $dummy_total['total'] +=  ceil($c['quantity'] * $weight);
                                $dummy_total['brand'] = $c['attributes']->brand;
                                $dummy_total['category'] = $c['attributes']->category;
                                $dummy_total['order_type'] = "Kg Weight";
                            }
                        } else {
                            $dummy_total['total'] += $c['quantity'];
                            $dummy_total['brand'] = $c['attributes']->brand;
                            $dummy_total['category'] = $c['attributes']->category;
                            $dummy_total['order_type'] = "Nos";
                        }
                    } elseif ($b->order_type == 2) {
                        $dummy_total['total'] += $c['quantity'] * $c['price'];
                        $dummy_total['brand'] = $c['attributes']->brand;
                        $dummy_total['category'] = $c['attributes']->category;
                        $dummy_total['order_type'] = "Price";
                    } elseif ($b->order_type == 3) {
                        $dummy_total['total'] += $c['quantity'] * $c['attributes']->lit;
                        $dummy_total['brand'] = $c['attributes']->brand;
                        $dummy_total['category'] = $c['attributes']->category;
                        $dummy_total['order_type'] = "Liter";
                    }
                }
            }
            $final_data[] = $dummy_total;
        }

        //return response()->json($final_data);
        $limit_outline = array();
        $total = ceil(Cart::getTotal());
        $limit_msg = '';
        foreach ($final_data as $fd) {
            $limit_data = brand::find($fd['brand']);
            if ($limit_data->order_limit >= $fd['total']) {
                $limit_outline[] = $fd['brand'];
                if ($fd['order_type'] == "Price") {
                    $limit_msg .= '<div class="alert_box error">
        <b>' . $limit_data->brand . '</b> Brand Minimum Order Limit is  <i class="fas fa-rupee-sign" style="margin-top:5px;font-size:10px"></i>' . AppHelper::instance()->IND_money_format($limit_data->order_limit) . ', Please Order Equal Or Above Value!.
        <button class="close"></button> </div>';
                } else {
                    $limit_msg .= '<div class="alert_box error">
<b>' . $limit_data->brand . '</b> Brand Minimum Order Limit is  ' . $limit_data->order_limit .  ' ' . $fd['order_type'] . ', Please Order Equal Or Above Value!.
<button class="close"></button> </div>';
                }
            }
        }

        if (!Cart::isEmpty()) {
            $output = '<div class="container">
    <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>Shopping Cart</li>
    </ul>
    <section class="section_offset">
    ' . $limit_msg . '
    <br>
        <h1>Shopping Cart</h1>
        <div class="table_wrap">

            <table class="table_type_1 shopping_cart_table">

                <thead>

                    <tr>
                        <th class="product_image_col">Product Image</th>
                        <th class="product_title_col">Product Name</th>

                        <th>Price</th>
                        <th class="product_qty_col">Quantity</th>
                        <th>Total</th>
                        <th class="product_actions_col">Action</th>
                    </tr>

                </thead>

                <tbody>';
            //return response()->json($limit_msg);
            foreach ($cartCollection as $cartData) {

                $amount = ($cartData->quantity * $cartData->price);
                // if($cartData)
                //return response()->json($cartData['attributes']->product_id);
                if (isset($cartData['attributes']['color'])) {
                    $product = product::find($cartData['attributes']->product_id);
                    // return response()->json($product);
                } else {
                    $product = product::find($cartData->id);
                }
                // if (in_array(2, $layout_brand)) {

                //     return response()->json("1");
                // }
                // foreach($layout_brand as $b_row){
                //     if($product->brand_name == $b_row){

                //     }
                // }
                if (in_array((int) $product->brand_name, $limit_outline)) {

                    $output .= ' <tr class="error_layout">';
                } else {

                    $output .= ' <tr>';
                }
                $output .= '

    <td class="product_image_col" data-title="Product Image">';
                if ($product->category == 1) {

                    $output .= ' <a href="/product/' . $cartData->id . '" class="product_thumb"><img src="http://www.kagtech.net/KAGAPP/Partsupload/' . $product->product_image . '" alt="" style="width:50px"></a>';
                } else if ($product->category == 14 || $product->group_product != null) {
                    $brand = brand::find($product->brand_name);
                    $output .= ' <a href="/product/' . $cartData->id . '" class="product_thumb"><img src="' . asset('/upload_brand') . '/' . $brand->brand_image . '" alt="" style="width:50px"></a>';
                } else {
                    if (isset($cartData['attributes']['color'])) {
                        $output .= ' <a href="/product/' . $cartData['attributes']['product_id'] . '" class="product_thumb"><img src="' . asset('/product_img') . '/' . $product->product_image . '" alt="" style="width:50px"></a>';
                    } else {
                        $output .= ' <a href="/product/' . $cartData->id . '" class="product_thumb"><img src="' . asset('/product_img') . '/' . $product->product_image . '" alt="" style="width:50px"></a>';
                    }
                }



                if (isset($cartData['attributes']['color'])) {

                    $output .= '</td>
    <td data-title="Product Name">

        <a href="/product/' . $cartData['attributes']['product_id'] . '" class="product_title">' . $cartData->name . '</a>

        <ul class="sc_product_info">';
                    //$color = color::find($cartData['attributes']['color_id']);
                    if ($cartData['attributes']['color_code'] != "undefined") {

                        $output .= ' <li>Color Code : ' . $cartData['attributes']['color_code'] . '</li>';
                    }
                    if ($cartData['attributes']['lit'] != 0) {
                        $output .= '<li>Litreage : ' . $cartData['attributes']['lit'] . '</li>';
                    }
                } else {

                    $output .= '</td>
    <td data-title="Product Name">

        <a href="/product/' . $cartData->id . '" class="product_title">' . $cartData->name . '</a>

        <ul class="sc_product_info">';
                }
                if (!isset($cartData['attributes']['color'])) {
                    if (!isset($cartData['attributes']['steel'])) {
                        if (!isset($cartData['attributes']['tiles'])) {
                            if (count($cartData['attributes']) > 0) {
                                //unset($cartData['attributes']->brand);
                                // unset($cartData['attributes']['brand']);
                                //unset($cartData['attributes']['category']);
                                $dummyBox[] = $cartData['attributes'];

                                //return response()->json($dummyBox[0]);
                                foreach ($dummyBox as $key => $value) {
                                    foreach ($value as $field => $row) {
                                        if ($field != "category" && $field != "brand") {
                                            $output .= '<li>' . $field . ' : ' . $row . '</li>';
                                        }
                                    }
                                }
                                // $output .="I'm Not Paint Steel";
                            }
                        } else {
                            $bran = brand::find($cartData['attributes']['brand']);
                            $Pro = product::find($cartData['id']);
                            $output .= '<li>Tiles Brand : ' . $bran->brand . '</li><br>';
                            $output .= '<li>Tiles Size : ' . $Pro->width . '</li>';
                        }
                    }
                }
                if (isset($cartData['attributes']['steel'])) {
                    $output .= '<li>Unit Type : ' . $cartData['attributes']['unit_name'] . '</li>';
                }

                $output .= '  </ul>

    </td>

    <td class="subtotal" data-title="Price">
    ₹ ' . AppHelper::instance()->IND_money_format(ceil($cartData->price)) . '
    </td>

    <td data-title="Quantity">
        <div class="qty min clearfix">
            <button class="theme_button" data-direction="minus" onclick="updateqtyMinus(' . $cartData->id . ')">&#45;</button>
            <input type="text" name="cartQty" id="cartQty' . $cartData->id . '" value="' . $cartData->quantity . '">
            <button class="theme_button" data-direction="plus" onclick="updateqtyPlus(' . $cartData->id . ')">&#43;</button>
            <div class="left_side" style="margin-top: 12px;">
        <a href="javascript:void(null)" onclick="updateCart(' . $cartData->id . ')" class="button_blue middle_btn">Update</a>
    </div>
        </div>
    </td>

    <td class="total" data-title="Total">
    ₹ ' . AppHelper::instance()->IND_money_format(ceil($amount)) . '
    </td>

    <td data-title="Action">
        <a href="javascript:void(null)" onclick="removeItemCart(' . $cartData->id . ')" class="button_dark_grey icon_btn remove_product"><i class="icon-cancel-2"></i></a>
    </td>

</tr>';
            }
            //$total = $total + $shipping_charge;
            $output .= ' </tbody>
    </table>

</div>

<footer class="bottom_box on_the_sides">
    <div class="left_side">
        <a href="/" class="button_blue middle_btn">Continue Shopping</a>
    </div>
    <div class="right_side">
        <a href="javascript:void(null)" onclick="cleanCart()" class="button_grey middle_btn">Clear Shopping Cart</a>
    </div>
</footer>

</section>

<div class="section_offset">
<div class="row">
    <section class="col-sm-6">

    </section>
    <section class="col-sm-6">
        <h3>Total</h3>
        <div class="table_wrap">
            <table class="zebra">
                <tfoot>
                    ';

            $output .= '   <tr class="total">
                        <td>Total</td>
                        <td>₹ ' . AppHelper::instance()->IND_money_format(ceil($total)) . '</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <footer class="bottom_box text-center">
            <a class="button_blue middle_btn" href="/checkout">Proceed to Checkout</a>
            <div class="single_link_wrap">

            </div>
        </footer>
    </section>
</div>
</div>
</div>';
        } else {
            $output = '<div class="container">
    <ul class="breadcrumbs">
        <li><a href="index.html">Home</a></li>
        <li>Shopping Cart</li>
    </ul>
    <section class="section_offset">
        <h1 style="text-align:center">Your Shopping Cart is Empty</h1>
    </section>
</div>';
        }
        print $output;
    }

    public function cartMenu()
    {
        $cartCollection = Cart::getContent();
        $total = Cart::getTotal();
        $tax = round($total * 5 / 105, 2);
        $output = '';
        foreach ($cartCollection as $cartData) {
            $amount = ($cartData->quantity * $cartData->price);
            if (isset($cartData['attributes']['color'])) {
                $product = product::find($cartData['attributes']->product_id);
            } else {
                $product = product::find($cartData->id);
            }

            $output .= '
    <div class="animated_item">
    <div class="clearfix sc_product">';
            if ($product->category == 1) {

                $output .= ' <a href="/product/' . $cartData->id . '" class="product_thumb"><img src="http://www.kagtech.net/KAGAPP/Partsupload/' . $product->product_image . '" alt="" style="width:50px"></a>';
            } else if ($product->category == 14 || $product->group_product != null) {
                $brand = brand::find($product->brand_name);
                $output .= ' <a href="/product/' . $cartData->id . '" class="product_thumb"><img src="' . asset('/upload_brand') . '/' . $brand->brand_image . '" alt="" style="width:50px"></a>';
            } else {
                $output .= ' <a href="/product/' . $cartData->id . '" class="product_thumb"><img src="' . asset('/product_img') . '/' . $product->product_image . '" alt="" style="width:50px"></a>';
            }
            $output .= '  <a href="/product/' . $cartData->id . '" class="product_name">' . $cartData->name . '</a>
          <p>' . $cartData->quantity . 'x' . $cartData->price . ' = Rs ' . $amount . '</p>
          <button class="close" onclick="removeCartItem(' . $cartData->id . ')"></button>
    </div>
</div>';
        }

        $output .= '<div class="animated_item">
<ul class="total_info">
          <li class="total"><b><span class="price">Total:</span> Rs ' . ceil($total) . '</b></li>
    </ul>
</div>
<div class="animated_item">
    <a href="/cart" class="button_grey">View Cart</a>
    <a href="/checkout" class="button_blue">Checkout</a>
</div>';
        echo $output;
    }

    public function tilesProductAddtoCart(Request $request)
    {
        // $cart_qty = Cart::get($request->product_id);
        // $totalQty = $cart_qty['quantity'] + $request->button_qty;
        // $total_price = $request->sales_price * $totalQty;
        $product = product::find($request->product_id);
        $attribute = array(
            'tiles' => true, 'brand' => $product->brand_name,
            'category' => $product->category
        );
        Cart::add(array(
            'id' => $request->product_id,
            'name' => $request->product_name,
            'price' => $request->sales_price,
            'quantity' => $request->button_qty,
            'attributes' => $attribute,
        ));
        return response()->json(Cart::getContent());
    }

    public function steelProductAddtoCart(Request $request)
    {
        foreach ($request->data as $row) {
            $product = product::find($row['product_id']);
            $attribute = array(
                'steel' => true,
                'unit_name' => $row['unit_name'],
                'brand' => $product->brand_name,
                'category' => $product->category
            );
            Cart::add(array(
                'id' => $row['product_id'],
                'name' => $row['product_name'],
                'price' => $row['unit_price'],
                'quantity' => $row['qty'],
                'attributes' => $attribute,
            ));
        }
        return response()->json(Cart::getContent());
    }

    public function cartUpdateValue($id, $values)
    {
        $checkValue = Cart::get($id);
        if (isset($checkValue->attributes['color'])) {
            $product_data = product::find($checkValue->attributes['product_id']);
        } else {
            $product_data = product::find($id);
        }
        //return response()->json($checkValue);
        if ($product_data->order_limit != null) {
            if ($product_data->order_limit <= $values) {

                Cart::update($id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $values
                    ),
                ));
                return response()->json("OK");
            } else {
                return response()->json($product_data->order_limit);
            }
        } else {

            Cart::update($id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $values
                ),
            ));
            return response()->json("OK");
        }
    }
}
