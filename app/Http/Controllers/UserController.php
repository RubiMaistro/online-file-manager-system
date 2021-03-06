<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public $error = null;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the username modification surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewUsernameChangerSurface()
    {
        return view('user.change.username',[
            'error' => null
        ]);
    }

    /**
     * Show the password modification surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewPasswordChangerSurface()
    {
        return view('user.change.password',[
            'error' => null
        ]);
    }

    public function usernameChange(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $userId = auth()->user()->id;
        $user = User::find($userId);

        if(Hash::check($request->password, $user->password))
        {
            $userName = auth()->user()->username;
            if(Storage::exists('public/'.$request->name))
            {
                $this->error = "The ". $request->name ." username already exist!";

            } else {
                $this->error = null;

                Storage::move('public/'.$userName, 'public/'.$request->name);
                $user->username = $request->name;
                $user->save();

                return redirect('/');
            }
        } 
        
        return view('user.change.username',[
            'error' => $this->error
        ]);
        
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_new' => 'required',
            'password_confirmation' => 'required'
        ]);

        $userId = auth()->user()->id;
        $user = User::find($userId);

        if(Hash::check($request->password, $user->password))
        {
            if($request->password_new == $request->password_confirmation)
            {   
                $user->password = Hash::make($request->password_new);
                $user->save();
            }
            else
            {
                return view('user.change.password',[
                    'error' => "Passwords don't match."
                ]);
            }
        } 
        else
        {
            return view('user.change.password',[
                'error' => 'Password incorrect.'
            ]);
        }


        return redirect('/');
    }

}
