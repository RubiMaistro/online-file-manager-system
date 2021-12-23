<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\User;


class SendFileController extends Controller
{
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
     * Show file sending surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewSendFileSurface()
    {
        return view('files.send');
    }

    
}
