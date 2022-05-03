<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\AdminsPasswordResets;
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
    private $adminModel;
    private $adminPasswordResetModel;

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
        $this->adminModel = new Admin();
        $this->adminPasswordResetModel = new AdminsPasswordResets();
    }

    public function resetpasswordform($token)
    {
        if(!empty($token)) {
            $adminPasswordReset = AdminsPasswordResets::getAdminByToken($token);            
            if(!empty($adminPasswordReset)) {
                $pageMetaTitle = 'Reset Password';
                $pageTitle = 'Reset Password';
                return view('backend.auth.resetpassword',compact(['pageMetaTitle','pageTitle','adminPasswordReset']));
            } else {
                return redirect()->route('admin.forgotpassword')->with("failed",__('Your token has expired'));
            }
        } else {
            return redirect()->route('admin.forgotpassword')->with("failed",__('Email not found try again!'));
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

        $adminPasswordReset = [
            'token'    => $token
        ];

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first());
        } else {

            $adminPasswordResetData = AdminsPasswordResets::getAdminByToken($token);
            if(!empty($adminPasswordResetData)) {
                $adminData = [
                    'password'     => $request->password,
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
                $adminId = $adminPasswordResetData['admin_id'];
                $admin =  Admin::find($adminId);
                $admin = $admin->update($adminData);
                if(!is_null($admin)) {
                    $adminPasswordResetToken = [
                        'token'    => ''
                    ];
                    $adminPasswordResetRes = $this->adminPasswordResetModel->updateByAdminid($adminId,$adminPasswordResetToken);
                    return redirect()->route('admin.login')->withSuccess(__('Password changed successfully.'));
                } else {
                    //$this->session->setFlashdata('err_msg', 'Password changed error.');
                    $pageMetaTitle = 'Reset Password';
                    $pageTitle = 'Reset Password';
                    return view('backend.auth.resetpassword',compact(['pageMetaTitle','pageTitle','adminPasswordReset']));
                }
            } else {
                return redirect()->route('admin.forgotpassword')->with("failed",__('Your token is invalid or has expired'));
            }

        }
    }
}
