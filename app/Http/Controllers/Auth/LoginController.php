<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the correct Auth facade
use Illuminate\Support\Facades\Session; // Add this line to import the Session facade

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Add this method to verify the token is being stored in the session
    public function login(Request $request)
    {
        //dd($request);
        $this->validateLogin($request);

        if (Auth::attempt($request->only($this->username(), 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // If the login is successful, redirect to the intended route
            return redirect()->intended($this->redirectTo);
        }

        // If the login is not successful, redirect back with errors
        return $this->sendFailedLoginResponse($request);
    }
}