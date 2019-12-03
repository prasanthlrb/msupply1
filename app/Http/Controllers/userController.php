<?php

namespace App\Http\Controllers;

use App\Admin;
use Hash;
use Illuminate\Http\Request;
use App\role;
use DB;
use Auth;
use App\product;
use App\User;
use App\order;
use App\order_item;
use Illuminate\Support\Carbon;
use Analytics;
use Spatie\Analytics\Period;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard()
    {
        $analytic = Analytics::fetchMostVisitedPages(Period::days(7));
        return response()->json($analytic);
        $currentMonth = date('m');
        $product = product::all();
        $user = User::all();
        $order = order::all();
        if ($currentMonth != 01) {
            $previousMonth = $currentMonth - 01;
        } else {
            $previousMonth = 12;
        }
        //$low = DB::table('products')->whereRaw('stock_quantity < low_stock')->get();
        $low = product::whereRaw('stock_quantity < low_stock')->get();
        $cMonth = order::whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->select(DB::raw("SUM(total_amount) as get_total"))->get();
        $pMonth = order::whereRaw('MONTH(created_at) = ?', [$previousMonth])
            ->select(DB::raw("SUM(total_amount) as get_total"))->get();
        //$topProduct = order_item::whereRaw('MONTH(created_at) = ?',[$currentMonth])
        $topProduct = order_item::whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->select(DB::raw('COUNT(id) as cnt'), 'product_name')
            ->groupBy('product_name')
            ->orderBy('cnt', 'DESC')->get();
        $topCustomer = order::whereRaw('MONTH(created_at) = ?', [$currentMonth])
            ->select(DB::raw('COUNT(id) as cnt'), 'user_id')
            ->groupBy('user_id')
            ->orderBy('cnt', 'DESC')
            ->get();
        if (count($topCustomer) > 5) {
            $topCustomerCount = 5;
        } else {
            $topCustomerCount = count($topCustomer);
        }
        // return response()->json($topCustomer);
        // $customerCount = array();
        $countX = 0;
        foreach ($topCustomer as $row) {
            if ($countX >= 5) {
                break;
            }
            $users = User::find($row->user_id);
            $data = array(
                'customer_name' => $users->name,
                'order_count' => $row->cnt
            );
            $customerData[] = $data;
        }
        //return response()->json($customerData);
        return view('admin/dashboard', compact('product', 'user', 'order', 'low', 'cMonth', 'pMonth', 'topProduct', 'topCustomer'));
    }
    public function user()
    {
        //$emp = Admin::all();
        $role = role::all();

        $emp = DB::table('admins as a')
            ->join('roles as r', 'r.id', '=', 'a.role_id')
            ->select('a.emp_name', 'a.email', 'a.phone', 'a.id', 'r.role_name')
            ->get();
        $roles = role::find(Auth::guard('admin')->user()->role_id);
        return view('admin/user', compact('emp', 'role', 'roles'));
    }

    public function saveEmployee(Request $request)
    {
        $request->validate([
            'emp_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);
        $admin = new Admin;
        $admin->emp_name = $request->emp_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);
        $admin->role_id = $request->role_id;
        $admin->save();
        return response()->json(['message' => 'Successfully Save'], 200);
    }

    public function updateEmployee(Request $request)
    {
        $request->validate([
            'emp_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role_id' => 'required',
        ]);
        $admin = Admin::find($request->id);
        $admin->emp_name = $request->emp_name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->phone = $request->phone;
        $admin->role_id = $request->role_id;
        $admin->save();
        return response()->json(['message' => 'Successfully Update'], 200);
    }
    public function editEmployee($id)
    {
        $admin = Admin::find($id);
        return response()->json($admin);
    }
    public function deleteEmployee($id)
    {
        Admin::find($id)->delete();
        return response()->json(['message' => 'Successfully Delete'], 200);
    }
}
