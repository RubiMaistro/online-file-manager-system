<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;

class CreateTextFileController extends Controller
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
     * Show the text file creating surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewCreateTextFileSurface()
    {
        return view('files.createTextFile');
    }

    /**
     * Save text file.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createTextFile(Request $request) 
    {

        $request->validate([
            'name' => 'required',
            'text' => 'required'
        ]);

        $userName = auth()->user()->username;
        $filename = $request->name.'.txt';
        $destination_path = 'public/'. $userName.'/'.$filename;

        Storage::append($destination_path, $request->text);

        $file = new Files;

        $file->user_id = auth()->user()->id;
        $file->name = $request->name;
        $file->filename = $filename;
        $file->size = floatval(Storage::size($destination_path) / (1024*1024)); // size in MB

        $file->save();

        return redirect('/');
    }
}
