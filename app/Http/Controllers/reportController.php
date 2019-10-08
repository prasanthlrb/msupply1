<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\product;
use App\category;
use App\brand;
use App\transport;
use App\order_log;
use App\product_log;
use Yajra\DataTables\Facades\DataTables;
use DB;
use PDF;
use App\login_log;
use Illuminate\Support\Facades\Input;

class reportController extends Controller
{
    public function order()
    {
        $user = User::all();
        $product = product::all();
        $category = category::all();
        $brand = brand::all();
        return view('admin.report.order', compact('user', 'product', 'category', 'brand'));
    }
    public function transport()
    {
        $user = User::all();
        $product = product::all();
        $category = category::all();
        $vehicle = transport::all();
        return view('admin.report.transport', compact('user', 'product', 'category', 'vehicle'));
    }
    public function orderLog()
    {
        return view('admin.report.orderLog');
    }

    public function getOrderLog()
    {
        $orderLog = order_log::orderBy('id', 'DESC')->get();
        return Datatables::of($orderLog)

            ->addColumn('order_id', function ($orderLog) {
                return '<a href="/admin/order-item/' . $orderLog->order_id . '" >#' . $orderLog->order_id . '</a>';
            })
            ->addColumn('status', function ($orderLog) {
                return '' . $orderLog->change_status . '';
            })
            ->addColumn('employee', function ($orderLog) {
                return '' . $orderLog->employee_name . '';
            })
            ->addColumn('date', function ($orderLog) {
                return '' . $orderLog->created_at . '';
            })
            ->addIndexColumn()
            ->rawColumns(['order_id', 'status', 'employee', 'date'])
            ->make(true);
        //return response()->json($orderLog);
    }

    public function searchOrderLog($date1, $date2)
    {
        $orderLog = order_log::whereBetween('created_at', [$date1, $date2])->get();
        return Datatables::of($orderLog)

            ->addColumn('order_id', function ($orderLog) {
                return '<a href="/admin/order-item/' . $orderLog->order_id . '" >#' . $orderLog->order_id . '</a>';
            })
            ->addColumn('status', function ($orderLog) {
                return '' . $orderLog->change_status . '';
            })
            ->addColumn('employee', function ($orderLog) {
                return '' . $orderLog->employee_name . '';
            })
            ->addColumn('date', function ($orderLog) {
                return '' . $orderLog->created_at . '';
            })
            ->addIndexColumn()
            ->rawColumns(['order_id', 'status', 'employee', 'date'])
            ->make(true);
    }

    public function productLog()
    {
        return view('admin.report.productLog');
    }

    public function getProductLog()
    {
        $productLog = product_log::orderBy('id', 'DESC')->get();
        return Datatables::of($productLog)

            ->addColumn('product_id', function ($productLog) {
                return '<a href="/admin/editProduct/' . $productLog->product_id . '" >#' . $productLog->product_id . '</a>';
            })
            ->addColumn('type', function ($productLog) {
                return '' . $productLog->type . '';
            })
            ->addColumn('employee', function ($productLog) {
                return '' . $productLog->employee_name . '';
            })
            ->addColumn('date', function ($productLog) {
                return '' . $productLog->created_at . '';
            })
            ->addIndexColumn()
            ->rawColumns(['product_id', 'type', 'employee', 'date'])
            ->make(true);
        //return response()->json($orderLog);
    }

    public function searchProductLog($date1, $date2)
    {
        $productLog = product_log::whereBetween('created_at', [$date1, $date2])->get();
        return Datatables::of($productLog)

            ->addColumn('product_id', function ($productLog) {
                return '<a href="/admin/editProduct/' . $productLog->product_id . '" >#' . $productLog->product_id . '</a>';
            })
            ->addColumn('type', function ($productLog) {
                return '' . $productLog->type . '';
            })
            ->addColumn('employee', function ($productLog) {
                return '' . $productLog->employee_name . '';
            })
            ->addColumn('date', function ($productLog) {
                return '' . $productLog->created_at . '';
            })
            ->addIndexColumn()
            ->rawColumns(['product_id', 'type', 'employee', 'date'])
            ->make(true);
    }




    public function orderReport(Request $request)
    {

        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));

        $q = DB::table('orders as o');
        if (Input::has('from_date') && !empty(Input::get('from_date')) && Input::has('to_date') && !empty(Input::get('to_date'))) {
            $q->whereBetween('o.created_at', [$fdate, $tdate]);
        } elseif (Input::has('from_date') && !empty(Input::get('from_date'))) {
            $q->where('o.created_at', $fdate);
        } elseif (Input::has('to_date') && !empty(Input::get('to_date'))) {
            $q->where('o.created_at', $tdate);
        }

        if ($request->status != 6) {
            $q->where('o.order_status', $request->status);
        }

        if ($request->payment_type != 0) {
            $q->where('o.payment_type', $request->payment_type);
        }
        if ($request->transport_type != 0) {
            $q->where('o.transport_type', $request->transport_type);
        }

        if ($request->customer_type != 0) {
            if (Input::has('customer') && !empty(Input::get('customer'))) {
                $q->whereIn('o.user_id', $request->customer);
            } else {
                if ($request->customer_type == 1) {
                    $user = User::where('user_type', 'user')->select('id')->get();
                } else {
                    $user = User::where('user_type', 'company')->select('id')->get();
                }
                $q->whereIn('o.user_id', $user);
            }
        } else if ((Input::has('customer') && !empty(Input::get('customer')))) {
            $q->whereIn('o.user_id', $request->customer);
        }


        $q->join('order_items as i', 'o.id', '=', 'i.order_id');
        $q->join('users as u', 'o.user_id', '=', 'u.id');

        if (Input::has('product') && !empty(Input::get('product'))) {

            $q->whereIn('i.product_id', $request->product);
        } else {
            if ($request->cat != 0) {
                if ($request->brand != 0) {
                    $product1 = product::where('brand_name', $request->brand)->where('category', 'LIKE', "%{$request->cat}%")->get();
                    foreach ($product1 as $data) {
                        foreach (explode(',', $data->category) as $row) {
                            if ($row == $request->cat) {
                                $product[] = $data;
                                break;
                            }
                        }
                    }

                    $q->whereIn('i.product_id', $product);
                } else {
                    $product1 = product::where('category', 'LIKE', "%{$request->cat}%")->get();
                    foreach ($product1 as $data) {
                        foreach (explode(',', $data->category) as $row) {
                            if ($row == $request->cat) {
                                $product[] = $data;
                                break;
                            }
                        }
                    }
                    $q->whereIn('i.product_id', $product);
                }
            } else {
                if ($request->brand != 0) {
                    $product = product::where('brand_name', $request->brand)->get();
                    $q->whereIn('i.product_id', $product);
                }
            }
        }
        $q->select('o.*', 'i.product_name', 'i.qty', 'i.sales_price', 'i.tax_type', 'i.tax_percent', 'u.name', 'u.user_type', 'u.id as user_id', 'i.tax');
        $data  = $q->get();
        $pdf = PDF::loadView('admin.report.printOrder', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('order_report.pdf');
        //return response()->json($data);
    }



    public function getOrderReport(Request $request)
    {
        $product = [];
        if ($request->brand != 0 && $request->cat != 0) {
            $product1 = product::where('brand_name', $request->brand)->where('category', 'LIKE', "%{$request->cat}%")->get();
            foreach ($product1 as $data) {
                foreach (explode(',', $data->category) as $row) {
                    if ($row == $request->cat) {
                        $product[] = $data;
                        break;
                    }
                }
            }
        } else if ($request->brand != 0 && $request->cat == 0) {
            $product = product::where('brand_name', $request->brand)->get();
        } else if ($request->brand == 0 && $request->cat != 0) {
            $product1 = product::where('category', 'LIKE', "%{$request->cat}%")->get();
            foreach ($product1 as $data) {
                foreach (explode(',', $data->category) as $row) {
                    if ($row == $request->cat) {
                        $product[] = $data;
                        break;
                    }
                }
            }
        } else {
            $product = product::all();
        }
        $output = '';
        foreach ($product as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->product_name . '</option>';
        }
        return response()->json($output);
    }

    public function getOrderCustomerReport(Request $request)
    {
        if ($request->customer_type == 1) {
            $user = User::where('user_type', 'user')->get();
        } else if ($request->customer_type == 2) {
            $user = User::where('user_type', 'company')->get();
        } else {
            $user = User::all();
        }
        $output = '';
        foreach ($user as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        return response()->json($output);
    }

    public function transportReport(Request $request)
    {
        $fdate = date('Y-m-d', strtotime($request->from_date));
        $tdate = date('Y-m-d', strtotime($request->to_date));

        $q = DB::table('order_transports as ot');
        if (Input::has('from_date') && !empty(Input::get('from_date')) && Input::has('to_date') && !empty(Input::get('to_date'))) {
            $q->whereBetween('ot.created_at', [$fdate, $tdate]);
        } elseif (Input::has('from_date') && !empty(Input::get('from_date'))) {
            $q->where('ot.created_at', $fdate);
        } elseif (Input::has('to_date') && !empty(Input::get('to_date'))) {
            $q->where('ot.created_at', $tdate);
        }

        if ($request->status != 3) {
            $q->where('ot.status', $request->status);
        }

        if ($request->payment_type != 0) {
            $q->where('ot.payment_type', $request->payment_type);
        }

        if ($request->vehicle != 0) {
            $q->where('ot.vehicle_name', $request->vehicle);
        }

        if ($request->customer_type != 0) {
            if (Input::has('customer') && !empty(Input::get('customer'))) {
                $q->whereIn('ot.user_id', $request->customer);
            } else {
                if ($request->customer_type == 1) {
                    $user = User::where('user_type', 'user')->select('id')->get();
                } else {
                    $user = User::where('user_type', 'company')->select('id')->get();
                }
                $q->whereIn('ot.user_id', $user);
            }
        } else if ((Input::has('customer') && !empty(Input::get('customer')))) {
            $q->whereIn('ot.user_id', $request->customer);
        }

        $q->join('users as u', 'ot.user_id', '=', 'u.id');
        $q->select('ot.*', 'u.name');
        $data  = $q->get();
        $pdf = PDF::loadView('admin.report.printTransport', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('order_transport.pdf');
        //return response()->json($data);
    }

    public function loginLogs()
    {
        $logs = login_log::all();
        return view('admin.report.loginLogs');
    }

    public function getLoginLog()
    {
        $loginLog = login_log::orderBy('id', 'DESC')->get();
        //return response()->json($loginLog);
        return Datatables::of($loginLog)

            ->addColumn('ip', function ($loginLog) {
                return $loginLog->ip_address;
            })
            ->addColumn('type', function ($loginLog) {
                return '' . $loginLog->action . '';
            })
            ->addColumn('employee', function ($loginLog) {
                return $loginLog->emp_id;
            })
            ->addColumn('date', function ($loginLog) {
                return '' . $loginLog->created_at . '';
            })
            ->addIndexColumn()
            ->rawColumns(['ip', 'type', 'employee', 'date'])
            ->make(true);
    }
}
