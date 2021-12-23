@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="column">
                <div style="width:fit-content; background-color:darkslategray; color:white; padding: 2em; border-radius: 10px 40% 70% 40%">
                    <h3>It's a Web Application where you can:</h3>
                </div>
                <div class="row justify-content-end mb-4 mt-4">
                    <div class="mr-2" style="width:fit-content; height:fit-content; background-color:darkslategray; color:white; text-align:center; padding: 1em; border-radius: 70% 50% 70% 50%">
                        <label class="justify-content-center"> Upload files</label>
                    </div>
                    <div class="mr-2" style="width:fit-content; height:fit-content; background-color:darkslategray; color:white; text-align:center; padding: 1em; border-radius: 70% 50% 70% 50%">
                        <label class="justify-content-center"> Download files</label>
                    </div>
                    <div class="mr-2" style="width:fit-content; height:fit-content; background-color:darkslategray; color:white; text-align:center; padding: 1em; border-radius: 70% 50% 70% 50%">
                        <label class="justify-content-center"> Open files</label>
                    </div>
                    <div class="mr-2" style="width:fit-content; height:fit-content; background-color:darkslategray; color:white; text-align:center; padding: 1em; border-radius: 70% 50% 70% 50%">
                        <label class="justify-content-center"> Edit files</label>
                    </div>
                    <div class="mr-2" style="width:fit-content; height:fit-content; background-color:darkslategray; color:white; text-align:center; padding: 1em; border-radius: 70% 50% 70% 50%">
                        <label class="justify-content-center"> Delete files</label>
                    </div>
                </div>
            </div>
            <div class="card" style="background-color:whitesmoke; border-radius: 30px;">
                <div class="card-header" style="font-size: x-large; text-align: center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Enter your username" autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
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
