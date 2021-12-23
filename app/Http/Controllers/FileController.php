<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Files;
use App\Models\User;
use Illuminate\Support\Str;

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
        $userID = auth()->user()->id;
        $files = Files::where('user_id', '=', $userID)->sortable()->paginate(10);
        $sender = User::all();

        return view('home', [
            'files' => $files,
            'sender' => $sender
        ]);
    }

    /**
     * Show the saved files in list.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $userID = auth()->user()->id;
        $files = Files::where('filename', 'like', "%{$request->search}%")
            ->where('user_id', '=', $userID)
            ->sortable()->paginate(10);

        $files->where('name', 'like', "%{$request->search}%");
        $sender = User::all();

        return view('home', [
            'files' => $files,
            'sender' => $sender
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
            $userName = auth()->user()->username;
            $destination_path = 'public/'. $userName;

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

        Storage::delete('public/'.auth()->user()->username.'/'.$file->filename);
        session()->flash('message', 'Delete successful.');

        return redirect()->back();
    }

    public function downloadFile($id)
    {
        $file = Files::where('id', '=', $id)->get()->first();

        $path = 'public/'.auth()->user()->username.'/'.$file->filename;
        list($name, $extension) = explode('.', $file->filename);
        //dd($extension);

        $headers = array(
            'Content-Type: application/'.$extension
        );

        //dd($headers);

        return Storage::download($path, $file->filename);
    }
}
