<?php

namespace App\Http\Controllers\Backend\Auth;

use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Admin;
use App\Models\AdminsPasswordResets;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    private $adminModel;
    private $adminPasswordResetModel;

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

    /**
     * Show the forgotpassword form.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotpassword()
    {
        $pageMetaTitle = 'Forgot Password';
        $pageTitle = 'Forgot Password';
        return view('backend.auth.forgotpassword',compact(['pageMetaTitle','pageTitle']));
    }

    public function sendForgotPasswordLink(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191'
        ];
        
        //custom validation error messages.
        $messages = [
            'email.exists' =>  __('These credentials do not match our records.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first());
        } else {
            $email = $request->email;
            $adminData = Admin::getAdminByEmail($email); 
            if($adminData) {
                $this->sendPasswordResetLink($adminData);        
            } else {
                return redirect()->route('admin.forgotpassword')->withSuccess(__('Email does not exist.'));
            }
        }
    }

    private function sendPasswordResetLink($adminData)
    {
        $adminEmail = $adminData['email'];
        if (!empty($adminEmail))      
        {
            $passwordplain = "";
            $passwordplain  = rand(999999999,9999999999);
            $token = md5($passwordplain);
            $passwordResetLink = route('admin.resetpassword.form',$token);
            $adminId = $adminData['id'];

            $adminPasswordResetData = array();
            $adminPasswordResetData['email']    = $adminEmail;
            $adminPasswordResetData['token']    = $token;
            $adminPasswordResetData['admin_id']    = $adminId;
            $adminPasswordResetData['created_at']    = Carbon::now()->format('Y-m-d H:i:s');
            $adminPasswordResetData['updated_at']   = Carbon::now()->format('Y-m-d H:i:s');

            $adminPasswordReset = AdminsPasswordResets::getAdminByEmail($adminEmail, $adminId);
            $res = false;
            if($adminPasswordReset) {
                unset($adminPasswordResetData['admin_id']);
                $adminPasswordResetRes = $this->adminPasswordResetModel->updateByAdminid($adminId,$adminPasswordResetData);
            } else {
                $adminPasswordResetRes = AdminsPasswordResets::create($adminPasswordResetData);                
            }

            if(!is_null($adminPasswordResetRes)) {
                $res = true;
            }

            if($res != false) {

                $to_name = $adminData['first_name'];
                $to_email = $adminData['email'];
                $mail_message='Dear '.$adminData['first_name'].','. "\r\n";
                $mail_message.='Thanks for contacting us regarding to forgot password,<br> Please click on <a href="'.$passwordResetLink.'">link</a> to reset your password.</b>'."\r\n";
                $mail_message.='<br>If you face any issue in direct link, copy and use below link in your browser <br>';
                 $mail_message.= $passwordResetLink;

                $mail_message.='<br>Thanks & Regards';
                $mail_message.='<br>CI Master';

                echo  $mail_message; exit;

                $subject = 'Forgot password reset link';

                Mail::send(array(), array(), function($message) use ($to_name, $to_email, $subject, $mail_message) {
                    $message->to($to_email, $to_name)
                    ->subject($subject.'(Laravel Master)')
                    ->setBody($mail_message, 'text/html');
                    $message->from("donotreply@example.com","Laravel Master");
                });

                if (Mail::failures()) {
                    return redirect()->route('admin.forgotpassword')->with("failed",__('Failed to send password reset link, please try again!'));
                } else {
                   return redirect()->route('admin.forgotpassword')->withSuccess(__('Password reset link sent to your email!'));
                }
            } else {
                return redirect()->route('admin.forgotpassword')->with("failed",__('Failed to send password reset link, please try again!'));
            }
        }
        else
        {
            return redirect()->route('admin.forgotpassword')->with("failed",__('Email not found try again!'));
        }
    }

    
}
