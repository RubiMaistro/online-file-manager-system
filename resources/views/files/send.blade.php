@extends('layouts.app')

@section('content')
<head>
    
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: x-large; text-align: center">{{ __('Files') }}</div>
                <div class="card-body" style="font-size: large;">
                    <form id="form_files" method="POST" action="{{ url('/file/send') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-2 col-form-label text-md-right">Files</label>
                            <div class="col-md-6">
                                <div class="form-check column">
                                    @foreach ( $files as $file )
                                    <div>
                                        <input name="file" class="form-check-input" type="radio" value="{{ $file->filename }}" id="{{ $file->id }}">
                                        <label class="form-check-label" for="{{ $file->id }}">
                                            {{ $file->filename }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
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
