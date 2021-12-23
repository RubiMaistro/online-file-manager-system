@if (!$success)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color:lightblue">
                <div class="card-header" style="font-size: x-large; text-align: center">{{ __('Send File Manager') }}</div>
                <div class="card-body" style="font-size: large;">
                    <div>
                        <label style="color: red">{{ $fileErr }}</label>
                        <label style="color: red">{{ $usernameErr }}</label>
                    </div>
                    <div class="form-group row">
                        <div class="ml-4">
                            <label>{{ __('Send to') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input wire:model="receiverUsername" type="text" class="form-control" name="username" value="{{ old('name') }}" placeholder="Write here to whom you want to send a file(s)." required>
                        </div>
                        <div class="form-group row">
                            <div class="ml-4">
                                <button wire:click="sendFile" type="button" class="btn btn-dark">
                                    {{ __('Send File') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group column">
                        <div class="form-group row">
                            <div class="ml-4 column justify-content-center">
                                <div class="m-2">
                                    <label>Files</label>
                                </div>
                                <div class="m-2">
                                    <select wire:model="selectedFileId" class="form-control" style="height: fit-content">
                                        <option value="default" selected hidden>Select an Option</option>
                                        @forelse ($files as $file)
                                            @foreach ($file as $data)
                                                <option value="{{ $data['id'] }}">{{ $data['filename'] }}</option>
                                            @endforeach
                                        @empty
                                            <option value="none" selected hidden>Select an Option</option>
                                            <option value="empty" disabled selected>Empty</option>
                                        @endforelse
                                    </select>                     
                                </div>
                            </div>
                            <div class="m-2 pl-4">
                                <button type="button" class="btn btn-dark" wire:click="addFile" style="margin-top: 45px"> {{ __('Add File') }} </button>
                            </div>
                            <div class="column">
                                <div class="m-2 pl-4">
                                    <label>Selected</label>
                                </div>
                                <div class="m-2 pl-4">
                                    @if($selectedFiles != null)
                                        @foreach ($selectedFiles as $selectedFile)
                                            @foreach ($selectedFile as $data)
                                            <div class="row ml-2 mb-2 p-2" style="background-color:steelblue; padding: 0.3em; width: fit-content; font-size: 14px; border-radius: 10px">
                                                <div value="{{ $data['id'] }}">{{ $data['filename'] }}</div>
                                                <button wire:click="deleteFromSelected({{ $data['id'] }})" style="background-color: red; color: white; margin-left: 0.4em; border-radius: 50%; border-color:red">X</button>
                                            </div>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if($success)
<div class="justify-content-center">
    <h2>Sending successful!</h2>
    <h3 style="color: green; font-weight: bold">You send files to {{ $receiverUsername }}</h3>
    <button class="button btn-secondary" wire:click="sendNew">Send other files</button>
    <button class="button btn-primary" wire:click="toHome">Homepage</button>
</div>
@endif