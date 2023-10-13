<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
    
        // Get the selected region value from the form data
        $selectedBranch = $request->input('branch');
    
        // Log the selected region value
        Log::info('Selected Branch: ' . $selectedBranch);
    
        // Store the selected region in a session variable
        Session::put('selectedBranch', $selectedBranch);
    
    
        $this->validateLogin($request);
    
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        else {
            // Add error message to the session
            Session::flash('error', 'Login failed. Please check your credentials.');
            
            // Redirect back to the login page
            return redirect('/login')->withInput($request->only($this->username(), 'remember'));
        }
    
    }
    
}
