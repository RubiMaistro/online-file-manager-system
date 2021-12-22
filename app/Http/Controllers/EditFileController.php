<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditFileController extends Controller
{
    /**
     * Show the file modification surface.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function viewEditFileSurface($fileId)
    {
        $fileDB = Files::find($fileId);

        $userName = auth()->user()->username;
        $filename = $fileDB->filename;
        $destination_path = 'public/'. $userName.'/'.$filename;

        $fileStored = Storage::get($destination_path);
        $path_info = pathinfo(public_path($destination_path));
        $fileExtension = $path_info['extension'];

        return view('files.edit',[
            'file' => $fileDB,
            'content' => $fileStored,
            'extension' => $fileExtension
        ]);
    }

    public function editFile(Request $request, $fileId)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $file = Files::find($fileId);

        $userName = auth()->user()->username;
        $destination_path = 'public/'. $userName.'/'.$file->filename;

        Storage::delete($destination_path);
        Storage::append($destination_path, $request->text);

        $file->name = $request->name;
        $file->size = floatval(Storage::size($destination_path) / (1024*1024)); // size in MB

        $file->save();

        return redirect('/');
    }
}
