@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 100%; background-color:lightsteelblue">
                <div class="card-header" style="font-size: x-large; text-align: center">{{ __('File Modification Manager') }}</div>
                <div class="card-body" style="font-size: large;">
                    <form method="POST" action="{{ url('/file/edit/'.$file->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" style="font-size:18px; background-color:steelblue; color:white;" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $file->name }}" required autocomplete="name" autofocus >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($extension == "txt")
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right" for="text">Text</label>
                            <div class="col-md-6">
                                <textarea id="text" name="text" type="text" class="form-control" style="font-size:16px; background-color:steelblue; color:white; min-width: 500px; min-height: 250px; max-width: 600px; max-height: 450px">{{ $content }}</textarea>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row md-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="width: 40%">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
