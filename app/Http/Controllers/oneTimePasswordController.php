<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class oneTimePasswordController extends Controller
{
    public function otpLogin()
    {
        return view('auth.otp');
    }

    public function SendLoginOtp(Request $request)
    {
        $otp = rand(10000, 1000000);
        $message = $otp . " is your verification code for secure access";
        $user = User::where('phone', $request->phone_number)->first();
        if (isset($user->phone)) {
            $user1 = User::find($user->id);
            $user1->otp = $otp;
            $user1->save();
            $success = $this->sendMessage($message, $user->phone);
            return response()->json(['message' => 'Send Successfully'], 200);
        } else {
            return response()->json(['message' => 'SMS Not send to your Number'], 417);
        }
    }
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
    public function ReceivedLoginOtp(Request $request)
    {
        $user = User::where('phone', $request->phone_number)->first();
        if ($user->otp == $request->otp_number) {
            Auth::loginUsingId($user->id);
            return response()->json(['message' => 'Login Successfully'], 200);
        } else {
            return response()->json(['message' => 'Invalid OTP'], 417);
        }
    }

    public function SendRegisterOtp(Request $request)
    {
        $otp = rand(10000, 1000000);
        $message = $otp . " is your verification code for secure access";
        $this->sendMessage($message, $request->phone);
        return response()->json(['otp' => $otp], 200);
    }

    public function viewRegisterOtp()
    {
        return view('auth.reset');
    }
}
