<?php

namespace App\Http\Controllers\Customer\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
    }
    public function index(){
        return view('Customer.Auth.login');
    }

    public function success(){
        return view('Customer.Auth.message');
    }

    public function login(Request $request): RedirectResponse
    {
       try {
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
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate(); 
                return redirect()->intended('success-message')->with('title', 'Login success');
            }else{
                return redirect()->back()->withInput()->with('error_message', 'Email or password is incorrect');
            }
       } catch (\Throwable $exception) {;
            DB::rollBack();
            Log::channel('daily')->error('Message Register: '.$exception->getMessage().' Line :'.$exception->getLine());
            return redirect()->back()->withInput()->with('error_message', 'The system is experiencing an error. Please try again later');
       }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();  
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}