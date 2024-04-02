<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $checkSentOtp, $checkVerify;
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function index(){
        return view('Customer.Auth.register');
    }

    public function checkRegister(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required', 'string', 'max:255'
                ],
                'email' => [
                    'required', 'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'
                ],
                'password' => [
                    'required', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/','confirmed'
                ],
                'password_confirmation' => [
                    'required'
                ]
            ], [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name must be letters.',
                'email.required' => 'The email field is required.',
                'email.regex' => 'The email format is invalid.',
                'password.required' => 'The password field is required.',
                'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one special character, and be 8-20 characters long',
                'password_confirmation.required' => 'The password field is required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->withInput()->with('error_message', 'This account already exists');
            } else {
                $checkSentOtp =  $this->otpService->sentOtp($request);
                if ($checkSentOtp) {
                    return redirect()->route('otp');
                } else {
                    return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
                }
            }
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message Register: '.$exception->getMessage().' Line :'.$exception->getLine());
            return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
        }
    }

    public function register(Request $request)
    {
        try {
            $otpData = $request->session()->get('otp_data');
            if( $otpData != null){
                $data = base64_decode($otpData['encrypted_data']);
                $decodedArray = json_decode($data, true);
                $checkVerify = $this->otpService->verify($request);
                if ($checkVerify) {
                    $user = User::create([
                        'us_name' => $decodedArray['name'],
                        'email' => $decodedArray['email'],
                        'password' => Hash::make($decodedArray['password']),
                    ]);
                    $user->roles()->sync(4);
                    DB::commit();
                    Auth::login($user);
                    return view('Customer.Auth.message')->with('title', 'Register success');
                } else {
                    return redirect()->back()->withInput()->with('error_message', 'Invalid OTP');
                }
            }
            return redirect()->back()->withInput()->with('error_message', 'Expired otp');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message Register: '.$exception->getMessage().' Line :'.$exception->getLine());
            return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
        }
    }
}
