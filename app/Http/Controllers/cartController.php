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
class cartController extends Controller
{
    public function postCartItem(Request $request){
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
                if($product->amount != null){
                if($product->price_type == "discount"){
                    if($product->value_type == "percentage"){
                       $product->sales_price = $product->sales_price - ($product->sales_price * ($product->amount / 100));
                    }else{
                        $product->sales_price = $product->sales_price - $product->amount;;
                    }
                }else{
                     if($product->value_type == "percentage"){
                       $product->sales_price = $product->sales_price + ($product->sales_price * ($product->amount / 100));
                    }else{
                        $product->sales_price = $product->sales_price + $product->amount; 
                    }
                }
            }
            $cat = category::find($product->category);
             $attribute = array(
                            'product_type'=>$cat->category_name,
                            );
            Cart::add(array(
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->sales_price,
                'quantity' => $request->qty,
                'attributes' =>$getOption,
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



    public function getCartItem(Request $request){
        return response()->json($request);
    }

    public function paintProductAddtoCart(Request $request){
         $optionName = $request->product_id.'0'.$request->lit.'0'.$request->colors_id;
        //   $cart_qty = Cart::get($optionName);
        // $totalQty = $cart_qty['quantity'] + $request->button_qty;
        // $total_price = $request->paint_price * $totalQty;
        $attribute = array(
                            'color'=>true,
                            'product_id'=>$request->product_id,
                            'lit'=>$request->lit,
                            'color_id'=>$request->colors_id,
                            'color_code'=>$request->colors_code
                            );
         Cart::add(array(
                'id' => $optionName,
                'name' => $request->product_name,
                'price' => $request->paint_price,
                'quantity' => $request->button_qty,
                'attributes' =>$attribute,
            ));
         return response()->json(Cart::getContent());
    }

    public function cartData(){
        $cartCollection = Cart::getContent();
    $total = Cart::getTotal();
    $shipping_charge=0;
    
    if(!Cart::isEmpty()){
    $output='<div class="container">
    <ul class="breadcrumbs">

        <li><a href="index.html">Home</a></li>
        <li>Shopping Cart</li>

    </ul>

    <section class="section_offset">

        <h1>Shopping Cart</h1>

        <!-- - - - - - - - - - - - - - Shopping cart table - - - - - - - - - - - - - - - - -->

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
    foreach($cartCollection as $cartData){
        
          $amount = ($cartData->quantity * $cartData->price);
           // if($cartData)
           //return response()->json($cartData['attributes']->product_id);
           if(isset($cartData['attributes']['color'])){
            $product = product::find($cartData['attributes']->product_id);
           }else{
               $product = product::find($cartData->id);
           }

    $output .=' <tr>

    <td class="product_image_col" data-title="Product Image">';
 if($product->category == 1){

        $output .=' <a href="/product/'.$cartData->id.'" class="product_thumb"><img src="http://www.kagtech.net/KAGAPP/Partsupload/'.$product->product_image.'" alt="" style="width:50px"></a>';
    }
    else if($product->category == 14 || $product->group_product != null){
            $brand = brand::find($product->brand_name);
            $output .=' <a href="/product/'.$cartData->id.'" class="product_thumb"><img src="'.asset('/upload_brand').'/'.$brand->brand_image.'" alt="" style="width:50px"></a>';
        }else{
            if(isset($cartData['attributes']['color'])){
        $output .=' <a href="/product/'.$cartData['attributes']['product_id'].'" class="product_thumb"><img src="'.asset('/product_img').'/'.$product->product_image.'" alt="" style="width:50px"></a>';
    }else{
        $output .=' <a href="/product/'.$cartData->id.'" class="product_thumb"><img src="'.asset('/product_img').'/'.$product->product_image.'" alt="" style="width:50px"></a>';

            }
    }
        

    
        if(isset($cartData['attributes']['color'])){

             $output .='</td>
    <td data-title="Product Name">

        <a href="/product/'.$cartData['attributes']['product_id'].'" class="product_title">'.$cartData->name.'</a>

        <ul class="sc_product_info">';
            //$color = color::find($cartData['attributes']['color_id']);
           $output .=' <li>Color Code : '.$cartData['attributes']['color_code'].'</li>
                    <li>Litreage : '.$cartData['attributes']['lit'].'</li>';
        }else{
           
             $output .='</td>
    <td data-title="Product Name">

        <a href="/product/'.$cartData->id.'" class="product_title">'.$cartData->name.'</a>

        <ul class="sc_product_info">';
        }
        if(!isset($cartData['attributes']['color'])){
        if(!isset($cartData['attributes']['steel'])){
        if(!isset($cartData['attributes']['tiles'])){
        if(count($cartData['attributes'])>0){
            foreach($cartData['attributes'] as $key=>$value) {
                foreach($value as $field => $row) {
                    $output .='<li>'.$field.' : '.$row.'</li>';
                }
            }
           // $output .="I'm Not Paint Steel";
          }
          }
          }
          }
          if(isset($cartData['attributes']['steel'])){
              $output .='<li>Unit Type : '.$cartData['attributes']['unit_name'].'</li>';
          }

        $output .='  </ul>

    </td>

    <td class="subtotal" data-title="Price">
    ₹ '.$cartData->price.'
    </td>

    <td data-title="Quantity">
        <div class="qty min clearfix">
            <button class="theme_button" data-direction="minus" onclick="updateqtyMinus('.$cartData->id.')">&#45;</button>
            <input type="text" name="cartQty" id="cartQty'.$cartData->id.'" value="'.$cartData->quantity.'">
            <button class="theme_button" data-direction="plus" onclick="updateqtyPlus('.$cartData->id. ')">&#43;</button>
            <div class="left_side" style="margin-top: 12px;">
        <a href="javascript:void(null)" onclick="updateCart('. $cartData->id.')" class="button_blue middle_btn">Update</a>
    </div>
        </div>
    </td>

    <td class="total" data-title="Total">
    ₹ '.$amount.'
    </td>

    <td data-title="Action">
        <a href="javascript:void(null)" onclick="removeItemCart('.$cartData->id.')" class="button_dark_grey icon_btn remove_product"><i class="icon-cancel-2"></i></a>
    </td>

</tr>';
    }
    $total = $total+$shipping_charge;
    $output .=' </tbody>
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

                 $output .='   <tr class="total">
                        <td>Total</td>
                        <td>₹ '.$total.'</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <footer class="bottom_box text-center">
            <a class="button_blue middle_btn" href="/transports">Proceed to Checkout</a>
            <div class="single_link_wrap">

            </div>
        </footer>
    </section>
</div>
</div>
</div>';
}else{
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

    public function cartMenu(){
        $cartCollection = Cart::getContent();
    $total = Cart::getTotal();
    $tax = round($total*5/105,2);
    $output='';
    foreach($cartCollection as $cartData){
          $amount = ($cartData->quantity * $cartData->price);
            if(isset($cartData['attributes']['color'])){
            $product = product::find($cartData['attributes']->product_id);
           }else{
               $product = product::find($cartData->id);
           }

    $output .='
    <div class="animated_item">
    <div class="clearfix sc_product">';
    if($product->category == 1){

        $output .=' <a href="/product/'.$cartData->id.'" class="product_thumb"><img src="http://www.kagtech.net/KAGAPP/Partsupload/'.$product->product_image.'" alt="" style="width:50px"></a>';
    }
    else if($product->category == 14 || $product->group_product != null){
            $brand = brand::find($product->brand_name);
            $output .=' <a href="/product/'.$cartData->id.'" class="product_thumb"><img src="'.asset('/upload_brand').'/'.$brand->brand_image.'" alt="" style="width:50px"></a>';
        }else{
            $output .=' <a href="/product/'.$cartData->id.'" class="product_thumb"><img src="'.asset('/product_img').'/'.$product->product_image.'" alt="" style="width:50px"></a>';

    }
        $output .='  <a href="/product/'.$cartData->id.'" class="product_name">'.$cartData->name.'</a>
          <p>'.$cartData->quantity.'x'.$cartData->price.' = Rs '.$amount.'</p>
          <button class="close" onclick="removeCartItem('.$cartData->id.')"></button>
    </div>
</div>';
    }

$output .='<div class="animated_item">
<ul class="total_info">
          <li class="total"><b><span class="price">Total:</span> Rs '.$total.'</b></li>
    </ul>
</div>
<div class="animated_item">
    <a href="/cart" class="button_grey">View Cart</a>
    <a href="/transports" class="button_blue">Checkout</a>
</div>';
echo $output;
    }

    public function tilesProductAddtoCart(Request $request){
        // $cart_qty = Cart::get($request->product_id);
        // $totalQty = $cart_qty['quantity'] + $request->button_qty;
        // $total_price = $request->sales_price * $totalQty;
        $attribute = array('tiles'=>true);
         Cart::add(array(
                'id' => $request->product_id,
                'name' => $request->product_name,
                'price' => $request->sales_price,
                'quantity' => $request->button_qty,
                'attributes' =>$attribute,
            ));
         return response()->json(Cart::getContent());
    }

    public function steelProductAddtoCart(Request $request){
        foreach($request->data as $row){
            $attribute = array('steel'=>true,'unit_name'=>$row['unit_name']);
             Cart::add(array(
                    'id' => $row['product_id'],
                    'name' => $row['product_name'],
                    'price' => $row['unit_price'],
                    'quantity' => $row['qty'],
                    'attributes' =>$attribute,
            ));
           
        }
         return response()->json(Cart::getContent());
    }

    public function cartUpdateValue($id,$values){
        $checkValue = Cart::get($id);
        if(isset($checkValue->attribute['color'])){

        }else{
            $product_data = product::find($id);
        }
        if($product_data->order_limit != null){
            if($product_data->order_limit <= $values){
    
                Cart::update($id, array(
             'quantity' => array(
                 'relative' => false,
                 'value' => $values
       ),
         ));
         return response()->json("OK");
            }else{
                return response()->json($product_data->order_limit);
            }

        }else{
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
