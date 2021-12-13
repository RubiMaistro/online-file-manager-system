<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileExistsException;
use LEague\Flysystem\FileNotFoundException;

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

        try{
            $userName = auth()->user()->username;
            $from_path = 'public/'.$userName.'/'.$request->file;
            $to_path = 'public/'.$request->name.'/'.$request->file;

            Storage::copy($from_path, $to_path);

            $user = User::where('username', $request->name)->first();
            $send_file = Files::where('filename', '=', $request->file)->first();

            $file = new Files;
            $file->user_id = $user->id;
            $file->name = $send_file->name;
            $file->filename = $send_file->filename;
            $file->size = floatval(Storage::size($from_path) / (1024*1024));
            $file->sender_id = auth()->user()->id;

            $file->save();

        } catch(FileExistsException $e){
            session()->flash('message', $e);
            
        } catch(FileNotFoundException $e){
            session()->flash('message', $e);
        }

        return redirect('/');
    }
}
