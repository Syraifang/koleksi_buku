<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
// -----------------------

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate([
            'email' => $googleUser->email, // Pastikan pakai $googleUser
        ], [
            'name' => $googleUser->name,
            'id_google' => $googleUser->id,
            'password' => bcrypt(Str::random(16)), 
        ]);

        $otp = rand(100000, 999999);
        $user->update(['otp' => $otp]);

        session(['otp_email' => $user->email]);

        return redirect()->route('otp.view');
    }

    public function verifyOtp(\Illuminate\Http\Request $request)
    {
        $user = User::where('email', session('otp_email'))->first();

        if ($user && $user->otp == $request->otp) {
            Auth::login($user);
            $user->update(['otp' => null]);
            
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
    }
}