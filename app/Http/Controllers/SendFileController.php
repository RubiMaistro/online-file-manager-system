<?php

namespace App\Http\Controllers;

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
        return view('files.send');
    }

    
}
