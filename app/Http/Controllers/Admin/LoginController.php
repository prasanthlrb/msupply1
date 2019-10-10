<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;
use Illuminate\Http\Request;
use App\login_log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function logout(Request $request)
    {
        $log = new login_log;
        $log->emp_id = Auth::guard('admin')->user()->emp_name;
        $log->action = "Log out";
        $log->ip_address = $request->getClientIp();
        $log->save();
        $msg = Auth::guard('admin')->user()->emp_name . " is Logout Now, Using IP for " . $request->getClientIp();
        //$this->sendMessage($msg);
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return $this->loggedOut($request) ?: redirect('/admin/login');
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    protected function authenticated(Request $request, $user)
    {
        $log = new login_log;
        $log->emp_id = $user->emp_name;
        $log->action = "Log in";
        $log->ip_address = $request->getClientIp();
        $log->save();
        $msg = $user->emp_name . " is Login Now, Using IP for " . $request->getClientIp();
        //$this->sendMessage($msg);
    }
    public function username()
    {
        return 'email';
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    // public function login(Request $request){
    //     return ''.$request->email.'='.$request->password;
    // }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function sendMessage($msg)
    {
        $requestParams = array(
            'route' => '1',
            'username' => '8870050001',
            'password' => 'welcome*85',
            'senderid' => 'MSUPLY',
            'number' => 8870050001,
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

    // protected function loggedOut(Request $request)
    // {

    // }
}
