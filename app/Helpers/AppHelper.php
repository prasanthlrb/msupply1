<?php

namespace App\Helpers;

use Session;
use App\location_management;
use DB;

class AppHelper
{

    public function sendMessage($msg, $phone)
    {
        $requestParams = array(
            'route' => '1',
            'username' => '8870050001',
            'password' => 'welcome*85',
            'senderid' => 'MSUPLY',
            'number' => $phone,
            'message' => $msg
        );
        //merge API url and parameters
        $apiUrl = 'http://api.onhandsms.com/api/v2/sendsms?';
        foreach ($requestParams as $key => $val) {
            $apiUrl .= $key . '=' . urlencode($val) . '&';
        }
        $apiUrl = rtrim($apiUrl, "&");

        //API call
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_exec($ch);
        curl_close($ch);

        return true;
    }
    public function locationManagement($id)
    {
        try {
            $location = Session::get('locations');
            $lm = location_management::where('product_id', $id)->where('location', $location)->first();
            return $lm;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    public function productDiscount($row)
    {
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
        return $row;
    }
    function IND_money_format($number)
    {
        $decimal = (string) ($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for ($i = 0; $i < $length; $i++) {
            if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
                $delimiter .= ',';
            }
            $delimiter .= $money[$i];
        }

        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if ($decimal != '0') {
            $result = $result . $decimal;
        }

        return $result;
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
    public static function instance()
    {
        return new AppHelper();
    }
}
