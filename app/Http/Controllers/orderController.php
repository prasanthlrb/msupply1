<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\order_item;
use App\order_attribute;
use App\shipping;
use App\billing;
use App\User;
use App\product;
use App\order_transport;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Auth;
use App\role;
use App\order_log;
use App\paintOrderDetails;
use App\color;
use AppHelper;
use App\brand;

class orderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    public function order()
    {
        // $order = order::all();
        // $order_transport = order_transport::all();
        // return response()->json($order);
        $role = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.order', compact('role'));
    }

    public function allOrder($filter)
    {
        if ($filter != 6) {
            $order = DB::table('orders as o')
                ->where('o.order_status', $filter)
                ->join('users as u', 'o.user_id', '=', 'u.id')
                ->join('order_items as i', 'o.id', '=', 'i.order_id')
                ->select(
                    'o.id',
                    'o.created_at',
                    'o.order_status',
                    'o.payment_type',
                    'o.total_amount',
                    'o.transport_type',
                    'u.name',
                    'u.email',
                    'u.phone',
                    'u.user_type',
                    'i.product_name',
                    'i.qty',
                    'i.order_id'
                )
                ->orderBy('o.id', 'desc')->get();
        } else {
            $order = DB::table('orders as o')
                ->join('users as u', 'o.user_id', '=', 'u.id')
                ->join('brands as b', 'b.id', '=', 'o.brand_id')

                ->select(
                    'o.*',
                    'u.name',
                    'u.email',
                    'u.phone',
                    'u.user_type',
                    'o.id as order_id',
                    'b.brand_image'
                )
                ->orderBy('o.id', 'desc')->get();
        }
        return Datatables::of($order)
            ->addColumn('checkbox', function ($order) {
                return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $order->order_id . '"></td>';
            })
            ->addColumn('order_id', function ($order) {
                return '<a href="/admin/order-item/' . $order->order_id . '" >#' . $order->order_id . '</a>';
            })
            ->addColumn('order_details', function ($order) {

                return '<td>
                <img src="/upload_brand/' . $order->brand_image . '" alt="" style="width:150px">
    <p>order Date : ' . $order->created_at . '</p>
    <p>Total Value: ' . $order->total_amount . '</p>
    <p>' . $order->delivery_info . '</p>
    </td>';
            })
            ->addColumn('payment_type', function ($order) {
                if ($order->payment_type == 1) {
                    return '<td>
    Cash on Delivery</td>';
                } else {
                    return '<td>Online Payment</td>';
                }
            })
            ->addColumn('order_status', function ($order) {

                if ($order->order_status == 0) {
                    $status = '<b>Pending</b>';
                } else if ($order->order_status == 1) {

                    $status = '<b>Processing</b>';
                } else if ($order->order_status == 2) {

                    $status = '<b>Shipping</b>';
                } else if ($order->order_status == 3) {

                    $status = '<b>Delivered</b>';
                } else if ($order->order_status == 4) {

                    $status = '<b>on-hold</b>';
                } else {

                    $status = '<b>failed</b>';
                }
                return '<td>
    ' . $status . '
    </td>';
            })
            //    ->addColumn('transport_type', function($order){
            //     return '<td>
            //     '.$order->transport_type == "1" ? "KAS Earth Mover" : "Own Transport".'
            //     </td>';
            //     })
            ->addColumn('customer_details', function ($order) {
                return '<td>
   <p>' . $order->name . '</p>
    <p>' . $order->phone . '</p>
    </td>';
            })

            ->rawColumns(['order_id', 'order_details', 'payment_type', 'order_status', 'customer_details', 'checkbox'])
            ->make(true);
    }

    public function orderAction(Request $request)
    {
        if ($request->status != 6) {
            $order = order::whereIn('id', $request->id)->get();
            foreach ($order as $row) {
                $row->order_status = $request->status;
                $row->save();
                if ($request->status == 0) {
                    $status = '<b>Pending</b>';
                    $status_msg = 'Pending';
                } else if ($request->status == 1) {
                    $status = '<b>Processing</b>';
                    $status_msg = 'Processing';
                } else if ($request->status == 2) {
                    $status = '<b>Shipping</b>';
                    $status_msg = 'Shipping';
                } else if ($request->status == 3) {
                    $status = '<b>Delivered</b>';
                    $status_msg = 'Delivered';
                } else if ($request->status == 4) {
                    $status = '<b>on-hold</b>';
                    $status_msg = 'on-hold';
                } else {
                    $status = '<b>failed</b>';
                    $status_msg = 'failed';
                }
                $order_log = new order_log;
                $order_log->order_id  = $row->id;
                $order_log->change_status = $status;
                $order_log->employee_name = Auth::guard('admin')->user()->emp_name;
                $order_log->save();
                $brand_msg = brand::find($row->brand_id);
                $msg_items = order_item::where('order_id', $row->id)->get();
                $user_ = User::find($row->user_id);
                $msg_item_name = '';
                $msg_mobile = $user_->phone;
                // $message = "hi";
                foreach ($msg_items as $mitem) {
                    $msg_item_name .= '' . $mitem->product_name . ',';
                }
                $message = $status_msg . ': Your order for ' . $brand_msg->brand . ' Brand Product (' . $msg_item_name . ') with Order ID #' . $row->id . ' Total Amount is Rs.' . $row->total_amount . ' .';

                AppHelper::instance()->sendMessage($message, $msg_mobile);
            }
        }
        return response()->json(["Successfully Update"], 200);
    }
    public function orderItemAction(Request $request)
    {
        $orderChange = order::find($request->id);
        $orderChange->order_status = $request->status;
        $orderChange->save();
        if ($request->status == 0) {
            $status = '<b>Pending</b>';
            $status_msg = 'Pending';
        } else if ($request->status == 1) {
            $status = '<b>Processing</b>';
            $status_msg = 'Processing';
        } else if ($request->status == 2) {
            $status = '<b>Shipping</b>';
            $status_msg = 'Shipping';
        } else if ($request->status == 3) {
            $status = '<b>Delivered</b>';
            $status_msg = 'Delivered';
        } else if ($request->status == 4) {
            $status = '<b>on-hold</b>';
            $status_msg = 'on-hold';
        } else {
            $status = '<b>failed</b>';
            $status_msg = 'failed';
        }
        $order_log = new order_log;
        $order_log->order_id  = $orderChange->id;
        $order_log->change_status = $status;
        $order_log->employee_name = Auth::guard('admin')->user()->emp_name;
        $order_log->save();
        $brand_msg = brand::find($orderChange->brand_id);
        $msg_items = order_item::where('order_id', $orderChange->id)->get();
        $user_ = User::find($orderChange->user_id);
        $msg_item_name = '';
        $msg_mobile = $user_->phone;
        // $message = "hi";
        foreach ($msg_items as $mitem) {
            $msg_item_name .= '' . $mitem->product_name . ',';
        }
        $message = $status_msg . ': Your order for ' . $brand_msg->brand . ' Brand Product (' . $msg_item_name . ') with Order ID #' . $orderChange->id . ' Total Amount is Rs.' . $orderChange->total_amount . ' .';

        AppHelper::instance()->sendMessage($message, $msg_mobile);
        return response()->json(["Successfully Update"], 200);
    }

    public function orderItem($id)
    {
        $order = order::find($id);
        $items = order_item::where('order_id', $order->id)->get();
        $shipping = shipping::find($order->shipping_id);
        $billing = billing::find($order->billing_id);
        $user = User::find($order->user_id);

        $paint_details = paintOrderDetails::where('order_id', $order->id)->get();
        if ($paint_details->count() > 0) {

            $paint_body = '';
            $paint_title = '<th class="text-right">Color Code</th><th class="text-right">Litreage</th>';
            foreach ($paint_details as $pd)

                $paint_body .= '<td class="text-right">' . $pd->color_id . '</td><td class="text-right">' . $pd->lit . '</td>';
        } else {
            $paint_title = '';
            $paint_body = '';
        }
        $output = '
              <thead>
                          <tr>
                            <th>#</th>
                            <th>Item & Attributes</th>
                            <th class="text-right">Tax</th>
                            <th class="text-right">Rate</th>
                            <th class="text-right">quantity</th>
                            ' . $paint_title . '
                            <th class="text-right">Amount</th>
                          </tr>
                        </thead>
                        <tbody>';

        foreach ($items as $index => $item) {
            $output .= '
                            <tr>
            <th scope="row">' . ($index + 1) . '</th>
            <td>';
            //$product = product::find($item->product_id);
            $output .= ' <p>' . $item->product_name . '</p>';
            $attr = order_attribute::where('order_item_id', $item->id)->get();
            foreach ($attr as $arr) {
                $output .= ' <p>' . $arr->attr_name . ' : ' . $arr->terms . '</p>';
            }

            $output .= '
           <td class="text-right">(' . $item->tax_percent . '%) - ' . $item->tax_type . '</td>
           <td class="text-right">₹ ' . $item->sales_price . '</td>
           <td class="text-right">' . $item->qty . '</td>';
            if ($paint_details->count() > 0) {
                $pdetails = paintOrderDetails::where('order_item_id', $item->id)->first();
                $output .= '<td class="text-right">' . $pdetails->color_id . '</td><td class="text-right">' . $pdetails->lit . '</td>';
            }

            $output .= '<td class="text-right">₹ ' . $item->total_price . '</td>
         ';
            $output .= '
      </tr>';
        }



        if ($order->shipping_type == 1) {
            $result = '<tr>
         <td>Sub Total</td>
         <td class="text-right">₹ ' . ($order->total_amount - $order->shipping_value) . '</td>
       </tr>
       <tr>
         <td>Shipping &amp; handling</td>
         <td class="text-right">₹ ' . $order->shipping_value . '</td>
       </tr>';
        } else {
            $result = '<tr>
         <td>Sub Total</td>
         <td class="text-right">₹ ' . ($order->total_amount) . '</td>
       </tr>
       <tr>';
        }


        $result .= ' <tr>
         <td class="text-bold-800">Total</td>
         <td class="text-bold-800 text-right"> ₹ ' . $order->total_amount . '</td>
       </tr>';


        return view('admin.orderItem', compact('order', 'shipping', 'billing', 'user', 'output', 'result'));
    }

    public function orderTransport()
    {
        $role = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin.orderTransport', compact('role'));
    }

    public function orderTransportGet($filter)
    {
        if ($filter != 3) {
            $transport = DB::table('order_transports as t')
                ->where('t.status', $filter)
                ->join('users as u', 't.user_id', '=', 'u.id')
                ->select('t.*', 'u.name', 'u.email', 'u.phone', 'u.user_type')
                ->orderBy('t.id', 'desc')->get();

            //order_transport::where('status',$filter)->orderBy('id','desc')->get();
        } else {
            $transport = DB::table('order_transports as t')
                ->join('users as u', 't.user_id', '=', 'u.id')
                ->select('t.*', 'u.name', 'u.email', 'u.phone', 'u.user_type')
                ->orderBy('t.id', 'desc')->get();
        }
        return Datatables::of($transport)
            ->addColumn('checkbox', function ($transport) {
                return '<td><input type="checkbox" name="order_checkbox[]" class="order_checkbox" value="' . $transport->id . '"></td>';
            })
            ->addColumn('order_id', function ($transport) {
                return '<a href="/admin/order-transport-details/' . $transport->id . '" >#' . $transport->id . '</a>';
            })
            ->addColumn('distance', function ($transport) {
                return '<td>
                ' . $transport->distance . ' Km
                </td>';
            })
            ->addColumn('total', function ($transport) {
                return '<td>
                ₹ ' . $transport->total . '
                </td>';
            })
            ->addColumn('customer_details', function ($transport) {
                return '<td>
               <p>' . $transport->name . '</p>
                <p>' . $transport->phone . '</p>
                </td>';
            })
            ->addColumn('status', function ($transport) {
                if ($transport->status == 0) {
                    $status = '<b>Booked</b>';
                } else if ($transport->status == 1) {
                    $status = '<b>Delivery</b>';
                } else if ($transport->status == 2) {
                    $status = '<b>Cancel</b>';
                } else {
                    $status = '<b>failed</b>';
                }
                return '<td>
                    ' . $status . '
                    </td>';
            })
            ->rawColumns(['checkbox', 'order_id', 'distance', 'total', 'customer_details', 'status'])
            ->make(true);
    }
    public function orderTransportAction(Request $request)
    {
        // $orderChange = order_transport::find($request->id);
        // $orderChange->status = $request->status;
        // $orderChange->save();
        if ($request->status != 6) {
            $orderChange = order_transport::whereIn('id', $request->id)->get();
            foreach ($orderChange as $row) {
                $row->status = $request->status;
                $row->save();
            }
        }
        return response()->json(["Successfully Update"], 200);
    }

    public function orderTransportDetails($id)
    {
        $order = order_transport::find($id);
        $user = User::find($order->user_id);
        $shipping = shipping::find($order->shipping);
        $product = product::whereIn('id', explode(',', $order->order_item))->get();
        // return response()->json($product);
        return view('admin.orderTransportDetails', compact('order', 'user', 'shipping'));
    }
    public function orderTransportItemAction(Request $request)
    {
        $orderChange = order_transport::find($request->id);
        $orderChange->status = $request->status;
        $orderChange->save();
        return response()->json(["Successfully Update"], 200);
    }
    public function orderMail($id)
    {
        //$all = $request->all();
        // Mail::send('mail',compact('all'),function($message) use($all){
        //     $message->to('prasanthbca7@gmail.com','To LRB')->subject($all['cf_order_number']);
        //     $message->from('prasanthats@gmail.com','To Prasanth');
        // });
        //  $orderData = $request->all();
        // Mail::to($contactData['cf_email'])->send(new OrderMailable($orderData));
        //return 'Email was sent';
        return response()->json(['message' => 'Successfully Send'], 200);
        //return response()->json($contactData['cf_email']);
    }
}
