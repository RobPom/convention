<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Validator;
use Redirect;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       
        return view('home');
    }
    /*
    public function someAdminStuff(Request $request)
    {
        $request->user()->authorizeRoles('manager');
        return view(‘some.view’);
    }
    */

    public function add(Request $request)
    {   
        $request->user()->authorizeRoles(['organizer', 'admin']);
        return view('/member/add');
    }
    
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username'  => 'required|max:255',
            'firstname'  => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email' => 'required|email|unique:users',
        ]);
        // If validator fails, short circut and redirect with errors
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 

        
        //generate a password for the new users
        $pw = User::generatePassword();

        //add new user to database
        $user = new User;
        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = $pw;
        $user->save();
        $user->roles()->attach(Role::where('name', 'member')->first());
        User::sendWelcomeEmail($user);
        return redirect('/dashboard');
    }
}
