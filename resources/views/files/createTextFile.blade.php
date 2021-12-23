@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color:lightsalmon; font-weight:bold">
                <div class="card-header" style="font-size: x-large; text-align: center">{{ __('Create Text File Manager') }}</div>
                <div class="card-body" style="font-size: large;">
                    <div>
                        <label style="color: red">{{ $notEnteredErr }}</label>
                    </div>
                    <form method="POST" action="{{ url('/file/create/text') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('File Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Name it your file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right" for="text">{{ __('Text') }}</label>
                            <div class="col-md-6">
                                <textarea id="text" name="text" type="text" class="form-control" style="width: 400px; height: 100px" placeholder="Write a text here"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="width: 40%">
                                    {{ __('Store file') }}
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
