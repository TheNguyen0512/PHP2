<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetTokens;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class ForgetPasswordController extends Controller
{
    protected $otpService;
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function index()
    {
        return view('Customer.Auth.forgetPassword');
    }

    public function showResetPasswordForm($token)
    {
        return view('Customer.Auth.resetPassword', ['token' => $token]);
    }

    public function submitForgetPasswordForm(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required','regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'
                ],
            ], [
                'email.required' => 'The email field is required.',
                'email.regex' => 'The email format is invalid.',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $token = Str::random(64);
            $user = User::where('us_email', $request->email)->first();
            if (isEmpty($user)) {
                $checkSentOtp =  $this->otpService->sentForgetPassword($user->email, $token);            
                if ($checkSentOtp) {
                    if(PasswordResetTokens::where('email', $user->email)->exists()){
                        $chekPassToken = PasswordResetTokens::where('email', $user->email)->first();
                        $chekPassToken->token = $token;
                        $chekPassToken->save();
                    }else{
                        PasswordResetTokens::create([
                            'email' => $user->email,
                            'token' => $token,
                        ]);
                    }
                    $encryptedEmail = base64_encode(json_encode($user->email));
                    $request->session()->put('change_password_data', [
                        'encrypted_data' =>  $encryptedEmail,
                        'expires_at' => now()->addMinutes(60)
                    ]);
                    return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
                } else {
                    return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
                }
            }
            DB::commit();
            return redirect()->back()->withInput()->with('error_message', 'Account does not exist');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message Forget Password: '.$exception->getMessage().' Line :'.$exception->getLine());
            return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
        }
    }

    public function submitResetPasswordForm(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'password' => [
                    'required', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/','confirmed'
                ],
                'password_confirmation' => [
                    'required'
                ]
            ], [
                'password_confirmation.required' => 'The confirm password field is required',
                'password.required' => 'The password field is required',
                'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one special character, and be 8-20 characters long',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->session()->get('change_password_data');
            if($data != null){
                $email = json_decode(base64_decode($data['encrypted_data']), true);
                $passToken = PasswordResetTokens::where([
                    'email' =>  $email,
                    'token' => $request->token,
                ])->first();
                
                if (!isEmpty($passToken)) {
                    return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');;
                }
                $user = User::where('us_email', $email)->first();
                $user->us_password = Hash::make($request->password);
                $user->save();
                $request->session()->forget('change_password_data');
                return redirect()->route('success-message')->with('title', 'Change password success');
            }
            DB::commit();
            return redirect()->route('home');
        } catch (\Throwable $exception) {
            DB::rollBack();
            Log::channel('daily')->error('Message Forget Password: '.$exception->getMessage().' Line :'.$exception->getLine());
            return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
        }
    }
}
