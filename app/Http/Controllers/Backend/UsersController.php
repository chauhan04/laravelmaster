<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    private $userModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $pageMetaTitle = 'Users';
        $pageTitle = 'Users';
        $users = User::getUsers();

        return view('backend.users.index', compact('pageMetaTitle','pageTitle','users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $pageMetaTitle = 'Add User';
        $pageTitle = 'Add User';
        return view('backend.users.create', compact('pageMetaTitle','pageTitle'));
    }

    /**
     * Store a newly created user
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
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
            $userData['status'] = $request->status;

            $user = User::create($userData);
            if(!is_null($user)) {
                return redirect()->route('admin.users.index')->withSuccess(__('User created successfully.'));
            } else {
                return redirect()->back()->with("failed", __("User create error.")->withInput($request->all()));
            }
        }
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        $pageMetaTitle = 'User';
        $pageTitle = 'User';
        $user =  User::find($id);
        return view('backend.users.show',compact(['pageMetaTitle','pageTitle','user']));
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $pageMetaTitle = 'Edit User';
        $pageTitle = 'Edit User';
        $user = User::find($id);
        return view('backend.users.edit',compact(['pageMetaTitle','pageTitle','user']));
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $user = User::findOrFail($id);
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

        $userData = array();
        if ($request->has('password') && !empty($request->password)){
            $rules['password'] = 'min:6';
            $rules['confirm_password'] = 'min:6|same:password';
            $request->request->set('password',$request->password);
            $userData['password'] = $request->password;
        } else {
            $request->except(['password']);
        }

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->fails() ) {
            return redirect()->back()->with("failed", $validator->errors()->first())->withInput($request->all());
        } else {
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
            $userData['status'] = $request->status;

            $user = $user->update($userData);
            if(!is_null($user)) { 
                return redirect()->route('admin.users.index')->withSuccess(__('User updated successfully.'));
            } else {
                return redirect()->back()->with("failed", "User update error.")->withInput($request->all());
            }
        }
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        $user = User::deleteUser($id);
        if(!is_null($user)) { 
            return redirect()->route('admin.users.index')->withSuccess(__('User deleted successfully.'));
        } else {
            return redirect()->back()->with("failed", __("User delete error."));
        }
    }
}
