<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = RouteServiceProvider::USER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        if (auth()->user()->role_id == 1) {
            return '/user/dashboard1';
        }
        return '/user';
    }
    
    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $pageMetaTitle = 'Sign In';
        $pageTitle = 'Sign In';
        return view('frontend.auth.login',compact(['pageMetaTitle','pageTitle']));
    }
    
    /**
     * Login the user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $validator = $this->validator($request);
        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->onlyInput('email');
        }

        if(Auth::guard('web')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect()
            ->intended(route('frontend.dashboard'))
            ->with('status', __('You are Sign In!'));
        }
        
        //Authentication failed...
        return $this->loginFailed();
    }
    
    protected function guard(){
        return Auth::guard('web');
    }
    
    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()
        ->route('frontend.login')
        ->with('status', __('You have been logged out!'));        
    }
    
    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:users|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];
        
        //custom validation error messages.
        $messages = [
            'email.exists' =>  __('These credentials do not match our records.'),
        ];
        
        //validate the request.
        //$request->validate($rules,$messages);
        return $validator = Validator::make($request->all(), $rules, $messages);        
    }
    
    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        return redirect()
        ->back()
        ->withInput()
        ->with('error', __('Login failed, please try again!'));
    }
}
