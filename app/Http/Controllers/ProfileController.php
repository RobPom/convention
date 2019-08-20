<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\Convention;
use App\Role;
use App\BlogPost;
use App\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Validator;
use File;
use DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'posts', 'games');
    }

    /**
     * Show the user profile
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $convention = Convention::where('status' , 'active')->first();
        $member = User::find($id);
        $user = Auth::user();
        return view('profile.show')
        ->with('convention' , $convention)
            ->with('user', $user)
            ->with('member', $member);
    }
    public function posts($id)
    {   
        $convention = Convention::where('status' , 'active')->first();
        $member = User::find($id);
        $posts = BlogPost::orderByDesc('posted_on')->where('user_id' , $id)->whereNotNull('posted_on')->paginate(6);
        $categories = BlogCategory::orderBy('title')->get();
        return view('profile.member.posts')
            ->with('member', $member)
            ->with('posts' , $posts)
            ->with('categories' , $categories)
            ->with('pagename' , 'Published Posts');
    }

    public function unpublished($id)
    {   
        $convention = Convention::where('status' , 'active')->first();
        $member = User::find($id);
        $posts =  BlogPost::where('user_id' , $member->id)->whereNull('posted_on')->paginate(6);
       
        $categories = BlogCategory::orderBy('title')->get();
        return view('profile.member.posts')
            ->with('member', $member)
            ->with('posts' , $posts)
            ->with('categories' , $categories)
            ->with('pagename' , 'Unpublished Posts');
    }

    public function games($id)
    {   
        $convention = Convention::where('status' , 'active')->first();
        $member = User::find($id);
        $user = Auth::user();
        return view('profile.member.games')
        ->with('convention' , $convention)
            ->with('user', $user)
            ->with('member', $member);
    }


    public function user()
    {
        $user = Auth::user();
        return view('profile.user')->with('user', $user);
    }


    /**
     * Show the user dashboard
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $user = Auth::user();
        $convention = Convention::where('status', 'active')->first();
        return view('profile.dashboard')
            ->with('user', $user)
            ->with('convention', $convention);
    }

    /**
     * Show the user dashboard
     *
     * @return \Illuminate\Http\Response
     */

    public function organizer()
    {
        $user = Auth::user();
        $users = User::all();
        $conventions = Convention::all();
        $convention = Convention::where('status', 'active')->first();

        if(  $user->hasRole('admin') || $user->hasRole('organizer') ){
            return view('profile.organizer.dash')
            ->with('user', $user)
            ->with('users' , $users)
            ->with('conventions', $conventions)
            ->with('convention', $convention);     
        }
        abort(403, 'This action is unauthorized.');
    }

    public function admin()
    {
        $user = Auth::user();
        $users = User::all();
    
        $conventions = Convention::all();
        $convention = Convention::where('status', 'active')->first();

        if(  $user->hasRole('admin')){
            return view('profile.admin.dash')
            ->with('user', $user)
            ->with('users' , $users)
            ->with('conventions', $conventions)
            ->with('convention', $convention);     
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $members = User::all();


        if(  $user->hasRole('admin') || $user->hasRole('organizer') ){
            return view('profile.admin.users')
            ->with('user', $user)
            ->with('members', $members);
            
        }
        abort(403, 'This action is unauthorized.');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $user = Auth::user();
        $member = User::find($id); 
        if( $user->id == $id || $user->hasRole('organizer') || $user->hasRole('admin') ){
            return view('profile.edit')
            ->with('user', $user)
            ->with('member' , $member);
            
        }
        abort(403, 'This action is unauthorized.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   
    public function update(Request $request, $id)
    {
        $member = User::find($id);
        $user = Auth::user();
       
        $member->lastname = urldecode($member->lastname);

        $validator = Validator::make($request->all(), [
        
            "firstname'  => 'required|max:50|regex:/^[a-z ,.'-]+$/i",
            "lastname'  => 'required|max:50|regex:/^[a-z ,.'-]+$/i",
            "location'  => max:50|regex:/^[a-z ,.'-]+$/i",
            'description'  => 'max:240',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1999',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        } 
       
        $member->firstname = $request->input('firstname');
        $member->lastname = $request->input('lastname');

        if($request->input('organizer')){
            $member->roles()->attach(Role::where('name', 'organizer')->first());
        } else {
            $member->roles()->detach(Role::where('name', 'organizer')->first());
        }
        //dd($request->input('organizer'));
        /* handle the image upload */

        //if the user selected an image to upload
        if($request->hasFile('avatar')){
            //see if they are using the default profile image, if not delete the old image
            if($member->avatar != 'default.jpg'){
                Storage::delete('public/uploads/avatars/' . $member->avatar);
            }          
            //set up the file extention, construct the path, then save the image to disk
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('avatar')->storeAs('public/uploads/avatars', $fileNameToStore);
            //add the new image name to the user model
            $member->avatar = $fileNameToStore;
         }
       
        if($request->input('verify')){
            $member->verified = true;
        } else {
            $member->verified = false;
        }
       
        
        
        $member->save();

        // if a profile is attached, delete it then save.

        if( Profile::where('user_id', $member->id )->first()){
            $profile = Profile::where('user_id', $member->id )->first();
            $profile->delete();
        }

        $profile = new Profile();
        $profile->location = $request->input('location');
        $profile->description =  $request->input('description');

        $member->profile()->save($profile);


        if(Auth::id() == $id ) {
            return redirect('/profile')
            ->with('status', 'Profile Updated');
        }
        
        if (Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') ) {
            return redirect('profile/show/' . $member->id)
            ->with('status', 'member profile updated');
        }
        
    }
  
}
