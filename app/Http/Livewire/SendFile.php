<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Files;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SendFile extends Component
{
    public $senderUsername = null;
    public $receiverUsername = null;

    public $filesId = array();
    public $selectedFilesId = array();

    public $selectedFileId = null;

    public $fileErr = null;
    public $usernameErr = null;

    public $success = false;

    public function __construct()
    {
        $userID = auth()->user()->id;
        $user = User::where('id', '=', $userID)->get()->first();
        $this->senderUsername = $user->username;
        $array = Files::where('user_id', '=', $userID)->get();
        foreach($array as $e)
        {
            array_push($this->filesId, $e->id);
        }
    }

    public function addFile()
    {
        if($this->selectedFileId != null)
        {
            $this->selectedFilesId[count($this->selectedFilesId)] = $this->selectedFileId;
            if (($key = array_search($this->selectedFileId, $this->filesId)) !== false) {
                unset($this->filesId[$key]);
                unset($this->selectedFileId);
            }
        } else {
            $this->fileErr = 'Choose a file you want to send!';
        }
    }

    public function deleteFromSelected($id)
    {
        if (($key = array_search($id, $this->selectedFilesId)) !== false) {
            array_push($this->filesId, intval($this->selectedFilesId[$key]));
            unset($this->selectedFilesId[$key]);
        }
        //dd($this->selectedFilesId, $this->filesId);
    }

    public function sendFile()
    {
        if($this->receiverUsername != null)
        {
            $this->usernameErr = null;
            if(($username = User::where('username', '=', $this->receiverUsername)->get()->first()) != null)
            { 
                //dd($username->toArray());
                $this->usernameErr = null;
                if($this->selectedFilesId != null)
                {
                    //dd($this->selectedFilesId);
                    $this->fileErr = null;
                    foreach($this->selectedFilesId as $selectedFileId)
                    {
                        if(($sendFile = Files::where('id', '=', $selectedFileId)->get()->first()) != null)
                        {
                            //dd($file->toArray());
                            $this->fileErr = null;

                            $from_path = 'public/'.$this->senderUsername.'/'.$sendFile->filename;
                            $to_path = 'public/'.$this->receiverUsername.'/'.$sendFile->filename;

                            if(Storage::exists($to_path))
                            {
                                $this->fileErr = 'The "'.$this->receiverUsername.'" user already has a "'.$sendFile->filename.'" file like this!';
                            } else {

                                $this->fileErr = null;

                                $senderUser = User::where('username', '=', $this->senderUsername)->get()->first();
                                $receiverUser = User::where('username', '=', $this->receiverUsername)->get()->first();

                                $file = new Files;

                                $file->user_id = $receiverUser->id;
                                $file->name = $sendFile->name;
                                $file->filename = $sendFile->filename;
                                $file->size = floatval(Storage::size($from_path) / (1024*1024));
                                $file->sender_id = $senderUser->id;

                                if($file->save() && Storage::copy($from_path, $to_path))
                                {
                                    $this->success = true;
                                }
                            }

                            unset($this->selectedFileId);

                        }else{
                            $this->fileErr = 'File not found!';
                        }
                    }
                } else {
                    $this->fileErr = 'Add a file you want to send!';
                }
            } else {
                $this->usernameErr = 'The entered username does not exist!';
            }
        } else {
            $this->usernameErr = "Enter the receiver's username!";
        } 

    }

    public function toHome()
    {
        return redirect('/');
    }

    public function sendNew()
    {
        return redirect('/file/send');
    }

    public function render()
    {
        $files = array();
        $selectedFiles = array();

        foreach($this->filesId as $id)
        {
            array_push($files, Files::where('id', '=', $id)->get()->toArray());
        }
        foreach($this->selectedFilesId as $id)
        {
            array_push($selectedFiles, Files::where('id', '=', $id)->get()->toArray());
        }
        
        //dd($selectedFiles, $files, $this->selectedFileId, $this->filesId);
        return view('livewire.send-file',[
            'files' => $files,
            'selectedFiles' => $selectedFiles,
            'fileErr' => $this->fileErr,
            'usernameErr' => $this->usernameErr
            
        ]);
    }
}
