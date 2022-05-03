<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function dashboard() {
        $pageMetaTitle = 'Dashboard';
        $pageTitle = 'Dashboard';

        return view('frontend.dashboard',compact(['pageMetaTitle','pageTitle']));
    }

    public function profile() {
        $pageMetaTitle = 'Profile';
        $pageTitle = 'Profile';
        $userId = Auth::id();
        $user = User::find($userId);
        return view('frontend.users.profile',compact(['pageMetaTitle','pageTitle','user']));
    }

    public function editProfile() {
        $pageMetaTitle = 'Edit Profile';
        $pageTitle = 'Edit Profile';
        $userId = Auth::id();
        $user = User::find($userId);
        return view('frontend.users.editprofile',compact(['pageMetaTitle','pageTitle','user']));
    }

    public function saveProfile(Request $request) {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'username' => 'required|min:6',
            'email' => 'required|email|min:3',
            'address_line1' => 'required|min:3',
            'country' => 'required',
            'state' => 'required|min:3',
            'city' => 'required|min:3',
            'zipcode' => 'required|min:3',
        ];

        //custom validation error messages.
        $messages = [
            'country.required' =>  __('The country code field is required.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->withInput($request->all());
        } else {
            $userData = array();
            $userData['first_name'] = $request->first_name;
            $userData['last_name'] = $request->last_name;
            $userData['username'] = $request->username;
            $userData['email'] = $request->email;
            $userData['phone'] = $request->phone;
            $userData['address_line1'] = $request->address_line1;
            $userData['address_line2'] = $request->address_line2;
            $userData['country'] = $request->country;
            $userData['state'] = $request->state;
            $userData['city'] = $request->city;
            $userData['zipcode'] = $request->zipcode;

            $user = $user->update($userData);
            if(!is_null($user)) { 
                return redirect()->route('frontend.profile')->withSuccess(__('Profile updated successfully.'));
            } else {
                return redirect()->back()->with("failed", __("Profile update error."))->withInput($request->all());
            }
        }
    }

    public function changepassword() {
        $pageMetaTitle = 'Change Password';
        $pageTitle = 'Change Password';

        return view('frontend.users.changepassword',compact(['pageMetaTitle','pageTitle']));
    }

    public function changepasswordsave(Request $request) {
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $rules = [
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->withInput($request->all());
        } else {
            $current_password = $request->current_password;
            $pass = $user->password;
            if (Hash::check($current_password, $pass)) {
                $userData = array();
                $userData['password'] = $request->password;
                $user = $user->update($userData);
                if(!is_null($user)) { 
                    return redirect()->route('frontend.changepassword')->withSuccess(__('Password updated successfully.'));
                } else {
                    return redirect()->back()->with("failed", __("Password update error."))->withInput($request->all());
                }
            } else {
                return redirect()->back()->with("failed", __("Your current password is incorrect."))->withInput($request->all());
            }
        }
    }
}
