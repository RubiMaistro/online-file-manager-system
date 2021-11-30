<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Files;

class FileController extends Controller
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
     * Show the saved files in list.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $files = Files::all();

        $error = null;
        if(is_null($files))
        {
            $error = "Még nem adtál hozzá fájlt";
        }

        return view('home', [
            'files' => $files,
            'error' => $error
        ]);
    }

    /**
     * Show the file adding surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewAddFileSurface() 
    {
        return view('files.add');
    }

    /**
     * Save files.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeFile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required'
        ]);

        $file = new Files;

        if($request->hasFile('file'))
        {
            $destination_path = 'public/files';

            $file->user_id = auth()->user()->id;
            $file->name = $request->name;
            $file->filename = $request->file('file')->getClientOriginalName();
            $file->size = floatval($request->file('file')->getSize() / (1024*1024)); // size in MB
            $file->save();

            $request->file('file')->storeAs($destination_path, $file->filename);
        }
        
        session()->flash('message', $file->name. ' successfully saved.');

        return redirect('/');
    }


    public function deleteFile($id)
    {
        $file = Files::find($id);
        if(is_null($file)) {
            return response()->json(['message' => 'File not found'], 404);
        }
        $file->delete();
        session()->flash('message', 'Delete successful.');

        return redirect()->back();
    }
}
