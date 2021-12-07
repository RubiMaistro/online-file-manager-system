<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use App\Models\User;

class SendFileController extends Controller
{
    /**
     * Show file sending surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewSendFileSurface()
    {
        $userID = auth()->user()->id;
        $user = User::find($userID)->get();
        $files = Files::where('user_id', '=', $userID)->get();

        return view('files.send',[
            'user' => $user,
            'files' => $files
        ]);
    }

    public function sendFile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required'
        ]);
    }
}
