<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
            $user->name = $request->name;
            $user->save();
        } 
        else
        {
            return view('user.change.username',[
                'error' => 'Password incorrect.'
            ]);
        }

        return redirect('/');
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
