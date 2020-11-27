<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Murid;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME, $email;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL) && $request->has('email')) {
            $login = Murid::where('nis', request('email'))->first();
            if (!$login) {
                $login = Guru::where('nip', request('email'))->first();
                    if (!$login) {
                        return $this->sendFailedLoginResponse($request);
                    }
            }
            $this->email = $login->user->email;
            return ['email' => $this->email, 'password' => $request->password];
        } else {
            return $request->only($this->username(), 'password');
        }
        
    }
}
