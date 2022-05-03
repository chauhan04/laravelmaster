<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mail;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the about us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutus()
    {
        $pageMetaTitle = 'About Us';
        $pageTitle = 'About Us';

        return view('frontend.pages.aboutus',compact(['pageMetaTitle','pageTitle']));
    }

    /**
     * Show the contact us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactus()
    {
        $pageMetaTitle = 'Contact Us';
        $pageTitle = 'Contact Us';

        return view('frontend.pages.contactus',compact(['pageMetaTitle','pageTitle']));
    }

    /**
     * Send contact us email.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactemail(Request $request)
    {
        $pageMetaTitle = 'Contact Us';
        $pageTitle = 'Contact Us';

        $rules = [
            'name'    => 'required',
            'email'    => 'required|email|min:5|max:191',
            'subject' => 'required',
            'message' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->onlyInput('email');
        } else {
            $fromName = $request->name;
            $fromEmail = $request->email;
            $subject = $request->subject;
            $message = $request->message;

            $to_name = 'Developer';
            $to_email = 'developer8here@gmail.com';
            $mail_message = 'Name :'.$fromName.','. "\r\n";
            $mail_message .= 'Email :'.$fromEmail.','. "\r\n";
            $mail_message .= 'Message :'.$message. "\r\n";

            try {
                Mail::send(array(), array(), function($message) use ($to_name, $to_email, $subject, $mail_message) {
                    $message->to($to_email, $to_name)
                    ->subject($subject.'(Laravel Master)')
                    ->setBody($mail_message, 'text/html');
                    $message->from("donotreply@example.com","Laravel Master");
                });

                if (Mail::failures()) {
                    return redirect()->route('frontend.contactus')->with("failed",__('Failed to send email, please try again!'));
                } else {
                return redirect()->route('frontend.contactus')->withSuccess(__('Contact info sent successfully.'));
                }

            } catch (exception $e) {
                //code to handle the exception
                return redirect()->route('frontend.contactus')->with("failed",__('Failed to send email, please try again!'));
            }
        }
    }

    /**
     * save the subscribe data
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe()
    {
        //save the subscribe data
        $pageMetaTitle = 'Faq';
        $pageTitle = 'Faq';

        return redirect()->back();
    }




}
