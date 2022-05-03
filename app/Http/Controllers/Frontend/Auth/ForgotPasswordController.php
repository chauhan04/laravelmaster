<?php

namespace App\Http\Controllers\Frontend\Auth;

use Response;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\User;
use App\Models\UsersPasswordResets;
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
    private $userModel;
    private $userPasswordResetModel;

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

    /**
     * Show the forgotpassword form.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotpassword()
    {
        $pageMetaTitle = 'Forgot Password';
        $pageTitle = 'Forgot Password';
        return view('frontend.auth.forgotpassword',compact(['pageMetaTitle','pageTitle']));
    }

    public function sendForgotPasswordLink(Request $request)
    {
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:users|min:5|max:191'
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
            $userData = User::getUserByEmail($email); 
            if($userData) {
                $this->sendPasswordResetLink($userData);        
            } else {
                return redirect()->route('frontend.forgotpassword')->withSuccess(__('Email does not exist.'));
            }
        }
    }

    private function sendPasswordResetLink($userData)
    {
        $userEmail = $userData['email'];
        if (!empty($userEmail))      
        {
            $passwordplain = "";
            $passwordplain  = rand(999999999,9999999999);
            $token = md5($passwordplain);
            $passwordResetLink = route('frontend.resetpassword.form',$token);
            $userId = $userData['id'];

            $userPasswordResetData = array();
            $userPasswordResetData['email']    = $userEmail;
            $userPasswordResetData['token']    = $token;
            $userPasswordResetData['user_id']    = $userId;
            $userPasswordResetData['created_at']    = Carbon::now()->format('Y-m-d H:i:s');
            $userPasswordResetData['updated_at']   = Carbon::now()->format('Y-m-d H:i:s');

            $userPasswordReset = UsersPasswordResets::getUserByEmail($userEmail, $userId);
            $res = false;
            if($userPasswordReset) {
                unset($userPasswordResetData['user_id']);
                $userPasswordResetRes = $this->userPasswordResetModel->updateByUserid($userId,$userPasswordResetData);
            } else {
                $userPasswordResetRes = UsersPasswordResets::create($userPasswordResetData);                
            }

            if(!is_null($userPasswordResetRes)) {
                $res = true;
            }

            if($res != false) {

                $to_name = $userData['first_name'];
                $to_email = $userData['email'];
                $mail_message='Dear '.$userData['first_name'].','. "\r\n";
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
                    return redirect()->route('frontend.forgotpassword')->with("failed",__('Failed to send password reset link, please try again!'));
                } else {
                   return redirect()->route('frontend.forgotpassword')->withSuccess(__('Password reset link sent to your email!'));
                }
            } else {
                return redirect()->route('frontend.forgotpassword')->with("failed",__('Failed to send password reset link, please try again!'));
            }
        }
        else
        {
            return redirect()->route('frontend.forgotpassword')->with("failed",__('Email not found try again!'));
        }
    }

    
}
