<?php

namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{

    public function index()
    {
        $pageMetaTitle = 'Admins';
        $pageTitle = 'Admins';
        $admins = Admin::getAdmins();
        return view('backend.admins.index',compact(['pageMetaTitle','pageTitle','admins']));
    }

    public function create(Request $request)
    {
        $pageMetaTitle = 'Add Admin';
        $pageTitle = 'Add Admin';
        return view('backend.admins.create',compact(['pageMetaTitle','pageTitle']));
    }

    public function store(Request $request)
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
            'state' => 'required|min:6',
            'city' => 'required|min:3',
            'zipcode' => 'required|min:3',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->withInput($request->all());
        } else {
            $admin = Admin::create($request->all());
            if(!is_null($admin)) {
                return redirect()->route('admin.admins.index')->withSuccess(__('Admin created successfully.'));
            } else {
                return redirect()->back()->with("failed", __("Admin create error.")->withInput($request->all()));
            }
        }
    }

    public function show($id)
    {
        $pageMetaTitle = 'Admin';
        $pageTitle = 'Admin';
        $admin =  Admin::find($id);
        return view('backend.admins.show',compact(['pageMetaTitle','pageTitle','admin']));
    }

    public function edit($id)
    {
        $pageMetaTitle = 'Edit Admin';
        $pageTitle = 'Edit Admin';
        $admin = Admin::find($id);
        return view('backend.admins.edit',compact(['pageMetaTitle','pageTitle','admin']));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
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

        if ($request->has('password') && !empty($request->password)){
            $rules['password'] = 'min:6';
            $rules['confirm_password'] = 'min:6|same:password';
            $request->request->set('password',$request->password);
        } else {
            $request->except(['password']);
        }

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->withInput($request->all());
        } else {
            $admin = $admin->update($request->all());
            if(!is_null($admin)) { 
                return redirect()->route('admin.admins.index')->withSuccess(__('Admin updated successfully.'));
            } else {
                return redirect()->back()->with("failed", "Admin update error.")->withInput($request->all());
            }
        }
    }

    public function destroy($id)
    {
        $admin = Admin::deleteAdmin($id);
        if(!is_null($admin)) { 
            return redirect()->route('admin.admins.index')->withSuccess(__('Admin deleted successfully.'));
        } else {
            return redirect()->back()->with("failed", __("Admin delete error."));
        }
    }
}
