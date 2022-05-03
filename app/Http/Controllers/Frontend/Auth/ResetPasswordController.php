<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersPasswordResets;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    private $userModel;
    private $userPasswordResetModel;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
        $this->userModel = new User();
        $this->userPasswordResetModel = new UsersPasswordResets();
    }

    public function resetpasswordform($token)
    {
        if(!empty($token)) {
            $userPasswordReset = UsersPasswordResets::getUserByToken($token);            
            if(!empty($userPasswordReset)) {
                $pageMetaTitle = 'Reset Password';
                $pageTitle = 'Reset Password';
                return view('frontend.auth.resetpassword',compact(['pageMetaTitle','pageTitle','userPasswordReset']));
            } else {
                return redirect()->route('frontend.forgotpassword')->with("failed",__('Your token has expired'));
            }
        } else {
            return redirect()->route('frontend.forgotpassword')->with("failed",__('Email not found try again!'));
        }
    }

    public function resetpassword(Request $request)
    {
        $token = $request->token;
        $rules = [
            'token'          => 'required',
            'password'         => 'required|min:6',
            'confirm_password'         => 'required|min:6|same:password'
        ];

        $validator = Validator::make($request->all(), $rules);

        $userPasswordReset = [
            'token'    => $token
        ];

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first());
        } else {

            $userPasswordResetData = UsersPasswordResets::getUserByToken($token);
            if(!empty($userPasswordResetData)) {
                $userData = [
                    'password'     => $request->password,
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
                $userId = $userPasswordResetData['user_id'];
                $user =  User::find($userId);
                $user = $user->update($userData);
                if(!is_null($user)) {
                    $userPasswordResetToken = [
                        'token'    => ''
                    ];
                    $userPasswordResetRes = $this->userPasswordResetModel->updateByUserid($userId,$userPasswordResetToken);
                    return redirect()->route('frontend.login')->withSuccess(__('Password changed successfully.'));
                } else {
                    //$this->session->setFlashdata('err_msg', 'Password changed error.');
                    $pageMetaTitle = 'Reset Password';
                    $pageTitle = 'Reset Password';
                    return view('frontend.auth.resetpassword',compact(['pageMetaTitle','pageTitle','userPasswordReset']));
                }
            } else {
                return redirect()->route('frontend.forgotpassword')->with("failed",__('Your token is invalid or has expired'));
            }

        }
    }
}
