<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {

        $pageMetaTitle = 'Sign Up';
        $pageTitle = 'Sign Up';
        return view('frontend.auth.register',compact(['pageMetaTitle','pageTitle']));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'username' => 'required|min:6',
            'email' => 'required|email|min:3',         
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'address_line1' => 'required|min:3',
            'country' => 'required',
            'state' => 'required|min:3',
            'city' => 'required|min:3',
            'zipcode' => 'required|min:3',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->withInput($request->all());
        } else {

            $userData = array();
            $userData['first_name'] = $request->first_name;
            $userData['last_name'] = $request->last_name;
            $userData['username'] = $request->username;
            $userData['email'] = $request->email;
            $userData['password'] = $request->password;
            $userData['confirm_password'] = $request->confirm_password;
            $userData['phone'] = $request->phone;
            $userData['address_line1'] = $request->address_line1;
            $userData['address_line2'] = $request->address_line2;
            $userData['country'] = $request->country;
            $userData['state'] = $request->state;
            $userData['city'] = $request->city;
            $userData['zipcode'] = $request->zipcode;
            $userData['status'] = 0;

            $user = User::create($userData);
            if(!is_null($user)) {
                return redirect()->route('frontend.login')->withSuccess(__('You registered successfully.'));
            } else {
                return redirect()->back()->with("failed", __("Registeration error.")->withInput($request->all()));
            }
        }
    }
}
