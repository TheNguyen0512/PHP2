<?php
namespace App\Services;

use App\Mail\ForgetPasswordNotification;
use App\Mail\OTPNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class OtpService
{
    public function sentOtp(Request $request)
    { 
        $otp = mt_rand(100000, 999999);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        if (!empty($email)) {
            $data = [
                'name' =>  $name,
                'email' =>  $email,
                'password' => $password
            ];
            $encrypted_data = base64_encode(json_encode($data));
            $encryptedOtp = base64_encode(json_encode($otp));
            $request->session()->put('otp_data', [
                'encrypted_data' =>  $encrypted_data,
                'otp' => $encryptedOtp,
                'expires_at' => now()->addMinutes(15)
            ]);
            $content = [
                'subject' => 'OTP ITP BLUE',
                'email' => $email,
                'otp' => $otp
            ];
            
            Mail::to($email)->send(new OTPNotification($content));
            return true;
        } else {
            return false;
        }
       
    }

    public function verify(Request $request)
    {
        $otpData = $request->session()->get('otp_data');
        $otp = base64_decode($otpData['otp']);
        if ($otp && $otp == $request->otp) {
            $request->session()->forget('otp_data');
            return true;
        }
        return false;
    }

    public function sentForgetPassword($email, $token)
    { 
        if (!empty($email)) {
            $content = [
                'subject' => 'ITP BLUE Forgot Password',
                'token' => $token,
            ];
            
            Mail::to($email)->send(new ForgetPasswordNotification($content));
            return true;
        } else {
            return false;
        }
       
    }
}